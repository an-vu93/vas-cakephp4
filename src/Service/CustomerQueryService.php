<?php
namespace App\Service;

use Cake\ORM\Query;
use Cake\ORM\TableRegistry;
use Cake\Database\Expression\QueryExpression;

class CustomerQueryService
{
    /**
     * Build base customer query with all required associations
     *
     * @param array $requestParams Query parameters
     * @return Query
     */
    public function buildCustomerQuery(array $requestParams = []): Query
    {
        $customersTable = TableRegistry::getTableLocator()->get('Customers');
        
        $analysisId = $requestParams['analysis_id'] ?? '0';

        $query = $customersTable->find();
        $query->select([
                'weighted_avg_score' => $query->newExpr('customer_weighted_average(Customers.id, :analysis)')
        ]);
        $query->bind(':analysis', $analysisId, 'integer');
        $query->contain([
                'CustomerProfiles' => [
                    'Industries',
                    'SubIndustries',
                    'SaleStores',
                    'Offices',
                    'OfficePersons',
                ],
               'CustomerProducts' => function ($q) {
                return $q->innerJoinWith('ProductTypes.OricohSeries')
                    ->contain(['ProductTypes' => ['OricohSeries']])
                    ->order(['CustomerProducts.id' => 'DESC']);
                },
                'Prefectures', 
                'CustomerMetrics',
                'CustomerScores',
                
            ]);

        $query->enableAutoFields(true);

        $query->where(['Customers.own_flg' => 0]);
        // Apply filters based on request parameters
        $query = $this->applyFilters($query, $requestParams);
        
        // Set lower boundary if exist
        if (!empty($requestParams['min_score'])) {
            $query->having(['weighted_avg_score >=' => $requestParams['min_score']]);
        }

        $query->distinct(['Customers.id']);

        return $query;
    }

    /**
     * Apply filters to the customer query
     *
     * @param Query $query
     * @param array $requestParams
     * @return Query
     */
    private function applyFilters(Query $query, array $requestParams): Query
    {
        // Customer ID or Name filter
        if (!empty($requestParams['query'])) {
            if (is_numeric($requestParams['query'])) {
                $query->where(['Customers.id' => $requestParams['query']]);
            } else {
                $query->where([
                    'Customers.name LIKE' => '%' . $requestParams['query'] . '%',
                ]);
            }
        }

        $query->innerJoinWith('CustomerProfiles', function ($q) use ($requestParams) {
            $conditions = [];

            // Prefecture filter
            if (!empty($requestParams['prefecture_id'])) {
                $conditions['CustomerProfiles.prefecture_id'] = $requestParams['prefecture_id'];
            }

            // Industry filter
            if (!empty($requestParams['industry_id'])) {
                $conditions['CustomerProfiles.industry_id'] = $requestParams['industry_id'];
            }

            // Sub-industry filter
            if (!empty($requestParams['sub_industry_id'])) {
                $conditions['CustomerProfiles.sub_industry_id'] = $requestParams['sub_industry_id'];
            }

            // Employee number filter
            if (!empty($requestParams['employee_number'])) {
                $conditions['CustomerProfiles.employee_number >='] = $requestParams['employee_number'];
            }

             // Capital filter
            if (!empty($requestParams['capital'])) {
                $conditions['CustomerProfiles.capital >='] = $requestParams['capital'];
            }

            // Revenue filter
            if (!empty($requestParams['revenue'])) {
                $conditions['CustomerProfiles.revenue >='] = $requestParams['revenue'];
            }
        
            return $q->where($conditions);
        });

        $query->innerJoinWith('CustomerProducts', function ($q) use ($requestParams) {
            $conditions = [];

            // Salesperson filter
            if (!empty($requestParams['salesperson_id'])) {
                $conditions['CustomerProducts.salesperson_id'] = $requestParams['salesperson_id'];
            }

            // OB version filter
            if (!empty($requestParams['product_type_id'])) {
                $conditions['CustomerProducts.product_type_id'] = $requestParams['product_type_id'];
            }

            // Contract status filter
            if (!empty($requestParams['contract_status'])) {
                $conditions['CustomerProducts.cancel_flg IN'] = $requestParams['contract_status'];
            }

            return $q->where($conditions);
        });

        $query->innerJoinWith('CustomerMetrics', function ($q) use ($requestParams) {
            $conditions = [];

            // Year month since last order filter
            if (!empty($requestParams['years_since_last_order']) || !empty($requestParams['months_since_last_order'])) {
                // Calculate the target date in PHP
                $duration = '';
                $duration .= $requestParams['years_since_last_order'] ? ($requestParams['years_since_last_order'] . ' years') : '';
                $duration .= $requestParams['months_since_last_order'] ? (' ' . $requestParams['months_since_last_order'] . ' months') : 'n';
                $targetDate = (new \DateTime())->modify('-' . trim($duration))->format('Y-m-d');
                // Contract status filter
                $conditions['CustomerMetrics.last_order_date <='] = $targetDate;
            }
            
            // PV filter
            if (!empty($requestParams['page_view_count'])) {
                $conditions['CustomerMetrics.page_view_count >='] = $requestParams['page_view_count'];
            }
            
            // Last order date filter
            if (!empty($requestParams['lastest_order_start_date'])) {
                $conditions['CustomerMetrics.last_order_date >='] = $requestParams['lastest_order_start_date'];
            }
            if (!empty($requestParams['lastest_order_end_date'])) {
                $conditions['CustomerMetrics.last_order_date <='] = $requestParams['lastest_order_end_date'];
            }
           
            return $q->where($conditions);
        });

        return $query;
    }
}
