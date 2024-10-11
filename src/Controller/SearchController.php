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
    public function initialize(): void
    {
        parent::initialize();

        // $this->loadModel('Indicators');
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

        if ($this->request->is('post')) {
            $searchData = $this->request->getData();
         
            $customersTable = $this->fetchTable('Customers');
    
            $query = $customersTable->find()
                ->contain(['CustomerOrders', 'Prefectures', 'Staffs']);

            if (!empty($searchData['query'])) {
                $query->where([
                    'OR' => [
                        'Customers.name LIKE' => '%' . $searchData['query'] . '%',
                        // 'Customers.id' => $searchData['query']
                    ]
                ]);
            }

            if (!empty($searchData['prefecture'])) {
                $query->where(['Customers.prefecture_id' => $searchData['prefecture']]);
            }


            $results = $query->all();
        }
        
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
