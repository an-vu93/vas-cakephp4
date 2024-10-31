<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Search Controller
 *
 * @method \App\Model\Entity\Search[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SearchController extends AppController
{
    // public $paginate = [
    //     'sortWhitelist' => [
    //         'id', 'name', 'Customers'
    //     ]
    // ];
    public function initialize(): void
    {
        parent::initialize();

        $this->viewBuilder()->setLayout('search');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $results = [];
        $searchData = [];
        $searchData = $this->request->getQuery();
         
        $customersTable = $this->fetchTable('Customers');

        $query = $customersTable->find()
            ->contain([
                'CustomerOrders' => [
                    'ProductTypes',
                    'Industries',
                    'SubIndustries',
                ],
                'Prefectures', 
                'CustomerMetrics',
        ]);

       
        if (!empty($searchData['query'])) {
            if (is_numeric($searchData['query'])) {
                $query->where(['Customers.id' => $searchData['query']]);
            } else {
                $query->where([
                    'Customers.name LIKE' => '%' . $searchData['query'] . '%',
                ]);
            }
        }

        if (!empty($searchData['prefecture_id'])) {
            $query->where(['Customers.prefecture_id' => $searchData['prefecture_id']]);
        }

        $this->paginate = [
            'contain' => [
                'Prefectures', 
                'CustomerOrders' => [
                    'ProductTypes',
                    'Industries',
                    'SubIndustries',
                ],
            ],
            'sortWhitelist' => [
                'Customers.id',
                'Customers.name',
                'Prefectures.id',
                'CustomerOrders.industry_id',
                'CustomerOrders.sub_ndustry_id',
            ],
        ]; 

        $results = $this->paginate($query, ['limit' => 20]);
                
        $prefectures = $this->fetchTable('Prefectures')->find('list', [
            'keyField' => 'id',
            'valueField' => 'name'
        ])->toArray();
        
        $salespeople = $this->fetchTable('Staffs')->find('list', [
            'keyField' => 'id',
            'valueField' => 'name'
        ])
        ->where([
            'team_id' => DS_SALE_TEAM_ID,
            'retire_flg !=' => DS_RETIRED
        ])
        ->toArray();

        $this->set(compact('results', 'searchData', 'prefectures', 'salespeople'));
    }

    /**
     * View method
     *
     * @param string|null $id Search id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $search = $this->Search->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('search'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        // $search = $this->Search->newEmptyEntity();
        // if ($this->request->is('post')) {
        //     $search = $this->Search->patchEntity($search, $this->request->getData());
        //     if ($this->Search->save($search)) {
        //         $this->Flash->success(__('The search has been saved.'));

        //         return $this->redirect(['action' => 'index']);
        //     }
        //     $this->Flash->error(__('The search could not be saved. Please, try again.'));
        // }
        // $this->set(compact('search'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Search id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $search = $this->Search->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $search = $this->Search->patchEntity($search, $this->request->getData());
            if ($this->Search->save($search)) {
                $this->Flash->success(__('The search has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The search could not be saved. Please, try again.'));
        }
        $this->set(compact('search'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Search id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $search = $this->Search->get($id);
        if ($this->Search->delete($search)) {
            $this->Flash->success(__('The search has been deleted.'));
        } else {
            $this->Flash->error(__('The search could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
