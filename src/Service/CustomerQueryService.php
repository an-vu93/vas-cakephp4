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
                ],
               'CustomerProducts' => function ($q) {
                    return $q->innerJoinWith('ProductTypes.OricohSeries');
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
            $query->having(['weighted_avg_score >' => $requestParams['min_score']]);
        }

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

        // Prefecture filter
        if (!empty($requestParams['prefecture_id'])) {
            $query->matching('CustomerProfiles', function ($q) use ($requestParams) {
                return $q->where(['CustomerProfiles.prefecture_id' => $requestParams['prefecture_id']]);
            });
        }

        // Salesperson filter
        if (!empty($requestParams['salesperson_id'])) {
            $query->matching('CustomerProducts', function ($q) use ($requestParams) {
                    return $q->where(['CustomerProducts.salesperson_id' => $requestParams['salesperson_id']]);
                })
                ->distinct();
        }

        // Industry filter
        if (!empty($requestParams['industry_id'])) {
            $query->matching('CustomerProfiles', function ($q) use ($requestParams) {
                return $q->where(['CustomerProfiles.industry_id' => $requestParams['industry_id']]);
            });
        }

        // Sub-industry filter
        if (!empty($requestParams['sub_industry_id'])) {
            $query->matching('CustomerProfiles', function ($q) use ($requestParams) {
                return $q->where(['CustomerProfiles.sub_industry_id' => $requestParams['sub_industry_id']]);
            });
        }

        // OB version filter
        if (!empty($requestParams['product_type_id'])) {
            $query->matching('CustomerProducts', function ($q) use ($requestParams) {
                return $q->where(['CustomerProducts.product_type_id' => $requestParams['product_type_id']]);
            });
        }

        // Employee number filter
        if (!empty($requestParams['employee_number'])) {
            $query->matching('CustomerProfiles', function ($q) use ($requestParams) {
                return $q->where(['CustomerProfiles.employee_number >=' => $requestParams['employee_number']]);
            });
        }

        // Capital filter
        if (!empty($requestParams['capital'])) {
            $query->matching('CustomerProfiles', function ($q) use ($requestParams) {
                return $q->where(['CustomerProfiles.capital >=' => $requestParams['capital']]);
            });
        }

        // Revenue filter
        if (!empty($requestParams['revenue'])) {
            $query->matching('CustomerProfiles', function ($q) use ($requestParams) {
                return $q->where(['CustomerProfiles.revenue >=' => $requestParams['revenue']]);
            });
        }

        return $query;
    }
}
