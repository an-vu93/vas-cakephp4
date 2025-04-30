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
        $activeIndicatorIds = [];
        $userActivityType = isset($requestParams['page']) ? 'ブラウジング' : '新検索';
        if (isset($requestParams['analysis_id'])) {
            $this->ActivityLog->logActivity($userActivityType, '以下の条件で検索が行われた: ' . json_encode($requestParams));
            $indicatorWeightTable = $this->fetchTable('IndicatorWeights');
            $activeIndicatorIds = $indicatorWeightTable->find()
                ->select(['indicator_id']) 
                ->where(['analysis_id' => $requestParams['analysis_id']])
                ->extract('indicator_id')
                ->toArray();     

                $this->set(compact('activeIndicatorIds'));
        }
        
        $prefecturesTable = $this->fetchTable('Prefectures');
        $staffTable = $this->fetchTable('Staffs');
        $industriesTable = $this->fetchTable('Industries');
        $subIndustriesTable = $this->fetchTable('SubIndustries');
        $productTypesTable = $this->fetchTable('ProductTypes');
        $analysesTable = $this->fetchTable('Analyses');
        $indicatorTable = $this->fetchTable('Indicators');
        $indicatorWeightTable = $this->fetchTable('IndicatorWeights');
           
        $indicators = $indicatorTable->find('list', [
            'keyField' => 'id',
            'valueField' => 'name'
        ])->toArray();       
      
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

        if (!empty($requestParams)) {
            // Build customer query using the service
            $customerQuery = $this->customerQueryService->buildCustomerQuery($requestParams);

            $this->paginate = [
                'contain' => [
                    'Prefectures', 
                    'CustomerProducts' => [
                        'ProductTypes'
                    ],
                    'CustomerMetrics',
                    'CustomerScores',

                ],
                'sortWhitelist' => [
                    'Customers.id',
                    'Customers.name',
                    'Customers.weighted_avg_score',
                    'Prefectures.id',
                    'CustomerProfiles.industry_id',
                    // 'CustomerProfiles.sub_ndustry_id',
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
            // dd($customers->first());
            $this->set(compact('customers'));
        }

        $dataSourceRef = '複数の外部データソースから取得され、統合された情報になります。<br>参照先（順番なし）：<br>・ハローワークインターネットサービス<br>・企業のホームページ<br>・gBizINFO';
        
        $relationshipStatuses = [
            'レベル- 関係力未確認',
            'レベル1 決裁者不明。お客様が弊社を認識させれていない。',
            'レベル2 担当者と表面レベルで話ができる。お客様が弊社の認知はある。',
            'レベル3 担当者から、覚えられている。',
            'レベル4 担当者から、バイネームで依頼が来る。決裁者との関係力が課題。',
            'レベル5 決裁者とも話ができ、相手からもバイネームで依頼が来る。'
        ];


        $this->set(compact('requestParams', 'prefectures', 'salespeople', 'industries', 'subIndustries', 'productTypes', 'analyses', 'indicators', 'dataSourceRef', 'relationshipStatuses'));
    }

    public function export() 
    {
        $this->Authorization->skipAuthorization();
        $this->autoRender = false;
        $response = $this->response;
        
        // Get query parameters
        $requestParams = $this->request->getQuery();
        
        $this->ActivityLog->logActivity('ファイル出力', '以下の条件で情報抽出が行われた: ' . json_encode($requestParams));

        // Set execution time limit
        set_time_limit(300);

        // Disable output buffering
        if (ob_get_level()) {
            ob_end_clean();
        }

        // Set headers for streamed download
        $filename = 'customer_export_' . date('Y-m-d_His') . '.csv';
        header('Content-Type: text/csv; charset=UTF-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        header('Pragma: public');

        // Open output stream directly to the browser
        $output = fopen('php://output', 'w');

        // Write UTF-8 BOM for Excel compatibility
        fwrite($output, "\xEF\xBB\xBF");
    
        // Prepare CSV headers
        $headers = [
            '顧客ID',
            '顧客名',
            '都道府県',
            '従業員数',
            '資本金',
            '年商',
            '親業種',
            '子業種',
            '最初受注日',
            '最終受注日',
            '過去のハローワーク求人',
            'OBシリーズの受注回数',
            'OBライセンス数',
            'OB以外ライセンス数',
            'お問い合わせの着信回数',
            'お問い合わせの送信回数',
            '週ログイン回数',
            '週編集回数',
            'PV回数',
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

        // Write headers
        fputcsv($output, $headers);

        flush();

        $batchSize = 6000;
        $page = 1;
        $moreRecords = true;
        
        while ($moreRecords) {
            try {
                // Create a clean query for each page to avoid carrying over states
                $pageQuery = $this->customerQueryService->buildCustomerQuery($requestParams)
                ->order(['weighted_avg_score' => 'DESC'])
                ->limit($batchSize)
                ->page($page);    
              
                $batch = $pageQuery->toArray();
                
                if (empty($batch)) {
                    $moreRecords = false;
                    continue;
                }

                foreach ($batch as $customer) {
                    $row = [
                        $customer->id,
                        $customer->name,
                        $customer->prefecture->name ?? '',
                        $customer->customer_profile->employee_number ?? '',
                        $customer->customer_profile->capital ?? '',
                        $customer->customer_profile->revene ?? '',
                        $customer->customer_profile->industry->name ?? '',
                        $customer->customer_profile->sub_industry->name ?? '',
                        $customer->customer_metric->first_order_date ? $customer->customer_metric->first_order_date->format('Y年m月d日') : '',
                        $customer->customer_metric->last_order_date ? $customer->customer_metric->last_order_date->format('Y年m月d日') : '',
                        $customer->customer_profile->hw_business_number ? '●' : '',
                        $customer->customer_metric->order_count ?? '',
                        $customer->customer_metric->oricoh_license_count ?? '',
                        $customer->customer_metric->other_license_count ?? '',
                        $customer->customer_metric->in_contact_count ?? '',
                        $customer->customer_metric->out_contact_count ?? '',
                        $customer->customer_metric->week_login_count ?? '',
                        $customer->customer_metric->week_edit_count ?? '',
                        $customer->customer_metric->page_view_count ?? '',
                    ];
                    
                    // Add scores if analysis is selected
                    if (!empty($requestParams['analysis_id'])) {
                        $scores = collection($customer->customer_scores)
                            ->combine('indicator_id', 'indicator_score')
                            ->toArray();
                            
                        foreach ($indicators as $indicator) {
                            $row[] = $scores[$indicator->id] ?? '';
                        }
                        
                        $row[] = $customer->weighted_avg_score ?? '';
                    }
                    
                    fputcsv($output, $row);

                    // Flush after each batch
                    flush();

                    // Free up memory
                    unset($batch);
                }
                    
                $page++;

            } catch (\Exception $e) {
                // Log batch-specific error but continue with next batch
                $this->log("Error processing batch {$page}: " . $e->getMessage(), 'error');
                $page++;
                
                // If we've had 3 consecutive batch errors, abort
                if ($page > 3 && empty($batch)) {
                    throw new \Exception('Multiple consecutive batch errors, aborting export');
                }
            }            
        }
        
        exit;
    }

    public function corporate()
    {
        $this->Authorization->skipAuthorization();
        $requestParams = [];
        $requestParams = $this->request->getQuery();
        if (isset($requestParams['corporate_number'])) {
    
            $corporationsTable = $this->fetchTable('Corporations');
        
            $corporation = $corporationsTable->find()
                ->where(['corporate_number' => $requestParams['corporate_number']])
                ->first();

            $dsCustomer = false;

            $customerProfilesTable = $this->fetchTable('CustomerProfiles');

            $dsCustomer = $customerProfilesTable->find()
                ->where(['corporate_number' => $requestParams['corporate_number']])
                ->first();

            if ($corporation) {
                $this->set(compact('corporation', 'requestParams', 'dsCustomer'));
            }

        }   
                
    }
}
