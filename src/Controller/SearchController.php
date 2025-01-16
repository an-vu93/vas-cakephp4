<?php
declare(strict_types=1);

namespace App\Controller;

use App\Service\CustomerQueryService;

/**
 * Search Controller
 *
 * @method \App\Model\Entity\Search[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SearchController extends AppController
{
    protected $customerQueryService;

    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('ActivityLog');
        $this->viewBuilder()->setLayout('search');
        $this->customerQueryService = new CustomerQueryService();
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();
        
        $customer = [];
        $requestParams = [];
        $requestParams = $this->request->getQuery();
        
        $userActivityType = isset($requestParams['page']) ? 'ブラウジング' : '新検索';
        if (isset($requestParams['analysis_id'])) {
            $this->ActivityLog->logActivity($userActivityType, '以下の条件で検索が行われた: ' . json_encode($requestParams));
        }
        
        $prefecturesTable = $this->fetchTable('Prefectures');
        $staffTable = $this->fetchTable('Staffs');
        $industriesTable = $this->fetchTable('Industries');
        $subIndustriesTable = $this->fetchTable('SubIndustries');
        $productTypesTable = $this->fetchTable('ProductTypes');
        $analysesTable = $this->fetchTable('Analyses');
        $indicatorTable = $this->fetchTable('Indicators');
        $indicatorWeightTable = $this->fetchTable('IndicatorWeights');

        // Build customer query using the service
        $customerQuery = $this->customerQueryService->buildCustomerQuery($requestParams);

       
        $indicators = $indicatorTable->find('list', [
            'keyField' => 'id',
            'valueField' => 'name'
        ])->toArray();
        
        $this->paginate = [
            'contain' => [
                'Prefectures', 
                'CustomerOrders' => [
                    'ProductTypes',
                ],
                'CustomerMetrics',
                'CustomerScores',

            ],
            'sortWhitelist' => [
                'Customers.id',
                'Customers.name',
                'Customers.weighted_avg_score',
                'Prefectures.id',
                'CustomerOrders.industry_id',
                // 'CustomerOrders.sub_ndustry_id',
                'CustomerProfiles.employee_number',
                'CustomerProfiles.capital',
                'CustomerProfiles.revenue',
                'CustomerProfiles.industry_id',
            ],
            'order' => [
                'Customers.weighted_avg_score' => 'DESC'
            ],
        ]; 

        $customers = $this->paginate($customerQuery, ['limit' => 20]);
      
        $prefectures = $prefecturesTable->find('list', [
            'keyField' => 'id',
            'valueField' => 'name'
        ])->toArray();
       
        $salespeople = $staffTable->find('list', [
            'keyField' => 'id',
            'valueField' => 'name'
        ])
        ->where([
            'team_id' => DS_SALE_TEAM_ID,
            'retire_flg !=' => DS_RETIRED
        ])
        ->toArray();

        $industries = $industriesTable->find('list', [
            'keyField' => 'id',
            'valueField' => 'name'
        ])
        ->toArray();

        $subIndustries = $subIndustriesTable->find('list', [
            'keyField' => 'id',
            'valueField' => 'name'
        ])
        ->toArray();

        $productTypes = $productTypesTable->find('list', [
            'keyField' => 'id',
            'valueField' => 'name'
        ])
        ->innerJoinWith('OricohSeries', function ($q) {
            return $q->where(['OricohSeries.cms_flg' => 1]);
        })
        ->distinct(['ProductTypes.id'])
        ->toArray();

        $analyses = $analysesTable->find('list', [
            'keyField' => 'id',
            'valueField' => 'name'
        ])->toArray();

        $dataSourceRef = '複数の外部データソースから取得され、統合された情報になります。<br>参照先（順番なし）：<br>・ハローワークインターネットサービス<br>・企業のホームページ<br>・gBizINFO';
        
        $this->set(compact('customers', 'requestParams', 'prefectures', 'salespeople', 'industries', 'subIndustries', 'productTypes', 'analyses', 'indicators', 'dataSourceRef'));
    }

    private function calculateWeightedAverage(array $scores, array $indicators): ? float 
    {
        if (empty($scores) || empty($indicators)) {
            return null;
        }

        $totalWeight = 0;
        $weightedSum = 0;

        foreach ($indicators as $indicator) {
            $indicatorId = $indicator['id'];
            $weight = $indicator['weight'];
            
            // Skip if we don't have a score for this indicator
            if (!isset($scores[$indicatorId])) {
                continue;
            }

            $score = $scores[$indicatorId];
            $weightedSum += $score * $weight;
            $totalWeight += $weight;
        }

        // Avoid division by zero
        if ($totalWeight === 0) {
            return null;
        }

        return round($weightedSum / $totalWeight, 2);
    }

    public function export() 
    {
        $this->Authorization->skipAuthorization();
        $this->autoRender = false;
        $response = $this->response;
        
        // Get query parameters
        $requestParams = $this->request->getQuery();
        
        $this->ActivityLog->logActivity('ファイル出力', '以下の条件で情報抽出が行われた: ' . json_encode($requestParams));
        
    
        // Initialize tables
        $customersTable = $this->fetchTable('Customers');
        
        // Build the query similar to index()
        $customerQuery = $this->customerQueryService->buildCustomerQuery($requestParams);
        
        // Apply the same filters as in index()
        if (!empty($requestParams['query'])) {
            if (is_numeric($requestParams['query'])) {
                $customerQuery->where(['Customers.id' => $requestParams['query']]);
            } else {
                $customerQuery->where([
                    'Customers.name LIKE' => '%' . $requestParams['query'] . '%',
                ]);
            }
        }

        if (!empty($requestParams['prefecture_id'])) {
            $customerQuery->where(['Customers.prefecture_id' => $requestParams['prefecture_id']]);
        }
        
    
        // Prepare CSV headers
        $headers = [
            '顧客ID',
            '顧客名',
            '都道府県',
            '最新のOB版',
            '従業員数',
            '資本金',
            '年商',
            '親業種',
            '子業種',
            '最初受注日',
            '最近受注日',
            'OBシリーズの受注回数',
            'OBライセンス数',
            'OB以外ライセンス数',
            'お問い合わせの着信回数',
            'お問い合わせの送信回数',
        ];

        $indicatorTable = $this->fetchTable('Indicators');

        // If analysis_id is present, add score headers
        if (!empty($requestParams['analysis_id'])) {
            $indicators = $indicatorTable->find()
                ->contain('IndicatorWeights')
                ->matching('IndicatorWeights')
                ->where(['IndicatorWeights.analysis_id' => $requestParams['analysis_id']])
                ->toArray();
                
            foreach ($indicators as $indicator) {
                $headers[] = $indicator->name;
            }
            $headers[] = '総合評価';
        }
        
        // Create a temporary file handle
        $filename = 'customer_export_' . date('Y-m-d_His') . '.csv';
        $fp = fopen('php://temp', 'w+');
        
        // Write UTF-8 BOM for Excel compatibility
        fwrite($fp, "\xEF\xBB\xBF");
        
        // Write headers
        fputcsv($fp, $headers);

        // Stream the response in chunks
        $chunkSize = 1000; // Adjust based on your memory constraints
        $page = 1;
        
        while (true) {
            $chunk = $customerQuery->limit($chunkSize)
                ->page($page)
                ->all();

            if ($chunk->isEmpty()) {
                break;
            }

            foreach ($chunk as $customer) {  
                    
                $row = [
                    $customer->id,
                    $customer->name,
                    $customer->prefecture->name ?? '',
                    !empty($customer->customer_orders) 
                        ? $customer->customer_orders[count($customer->customer_orders) - 1]->product_type->name 
                        : '',
                    $customer->customer_profile->employee_number ?? '',
                    $customer->customer_profile->capital ?? '',
                    $customer->customer_profile->revene ?? '',
                    $customer->customer_profile->industry->name ?? '',
                    $customer->customer_profile->sub_industry->name ?? '',
                    $customer->customer_metric->first_order_date ?? '',
                    $customer->customer_metric->last_order_date ?? '',
                    $customer->customer_metric->order_count ?? '',
                    $customer->customer_metric->oricoh_license_count ?? '',
                    $customer->customer_metric->other_license_count ?? '',
                    $customer->customer_metric->in_contact_count ?? '',
                    $customer->customer_metric->out_contact_count ?? '',
                ];
                
                // Add scores if analysis is selected
                if (!empty($requestParams['analysis_id'])) {
                    $scores = collection($customer->customer_scores)
                        ->combine('indicator_id', 'indicator_score')
                        ->toArray();
                        
                    foreach ($indicators as $indicator) {
                        $row[] = $scores[$indicator->id] ?? '';
                    }
                    
                    // // Calculate and add weighted average
                    // $weightedAverage = $this->calculateWeightedAverage($scores, 
                    //     collection($indicators)->map(function ($indicator) {
                    //         return [
                    //             'id' => $indicator->id,
                    //             'weight' => $indicator->_matchingData['IndicatorWeights']->weight
                    //         ];
                    //     })->toArray()
                    // );
                    $row[] = $customer->weighted_avg_score ?? '';
                }
                
                fputcsv($fp, $row);

                // Flush the output buffer periodically
                if (ob_get_length() > 10000) {
                    ob_flush();
                    flush();
                }
            }
            
            $page++;
            
            // Clear the current chunk from memory
            unset($chunk);

        } 
        
        // Reset file pointer
        rewind($fp);
        
        // Read file contents
        $csv = stream_get_contents($fp);
        fclose($fp);
        
        // Set response headers
        $response = $response->withType('csv');
        $response = $response->withDownload($filename);
        
        return $response->withStringBody($csv);
    }
}
