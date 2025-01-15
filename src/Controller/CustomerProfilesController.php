<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * CustomerProfiles Controller
 *
 * @property \App\Model\Table\CustomerProfilesTable $CustomerProfiles
 * @method \App\Model\Entity\CustomerProfile[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CustomerProfilesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $customerProfile = $this->CustomerProfiles->newEmptyEntity();
        $this->Authorization->authorize($customerProfile);
        
        $this->paginate = [
            'contain' => ['Customers', 'Prefectures'],
        ];
        $customerProfiles = $this->paginate($this->CustomerProfiles);

        $this->set(compact('customerProfiles'));
    }

    /**
     * View method
     *
     * @param string|null $id Customer Profile id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $customerProfile = $this->CustomerProfiles->get($id, [
            'contain' => ['Customers', 'Prefectures'],
        ]);

        $this->set(compact('customerProfile'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $customerProfile = $this->CustomerProfiles->newEmptyEntity();
        if ($this->request->is('post')) {
            $customerProfile = $this->CustomerProfiles->patchEntity($customerProfile, $this->request->getData());
            if ($this->CustomerProfiles->save($customerProfile)) {
                $this->Flash->success(__('The customer profile has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The customer profile could not be saved. Please, try again.'));
        }
        $customers = $this->CustomerProfiles->Customers->find('list', ['limit' => 200])->all();
        $prefectures = $this->CustomerProfiles->Prefectures->find('list', ['limit' => 200])->all();
        $this->set(compact('customerProfile', 'customers', 'prefectures'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Customer Profile id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $customerProfile = $this->CustomerProfiles->get($id, [
            'contain' => ['Customers', 'Prefectures'],
        ]);
        $this->Authorization->authorize($customerProfile);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $customerProfile = $this->CustomerProfiles->patchEntity($customerProfile, $this->request->getData());
            if ($this->CustomerProfiles->save($customerProfile)) {
                $this->Flash->success(__('The customer profile has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The customer profile could not be saved. Please, try again.'));
        }
        $customers = $this->CustomerProfiles->Customers->find('list', ['limit' => 200])->all();
        $prefectures = $this->CustomerProfiles->Prefectures->find('list', ['limit' => 200])->all();
        $this->set(compact('customerProfile', 'customers', 'prefectures'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Customer Profile id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $customerProfile = $this->CustomerProfiles->get($id);
        if ($this->CustomerProfiles->delete($customerProfile)) {
            $this->Flash->success(__('The customer profile has been deleted.'));
        } else {
            $this->Flash->error(__('The customer profile could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
