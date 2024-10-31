<?php
declare(strict_types=1);

namespace App\Controller;

use App\Service\ScoringService;
/**
 * CustomerScores Controller
 *
 * @property \App\Model\Table\CustomerScoresTable $CustomerScores
 * @method \App\Model\Entity\CustomerScore[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CustomerScoresController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Customers', 'Indicators'],
        ];
        $customerScores = $this->paginate($this->CustomerScores);

        $this->set(compact('customerScores'));
    }

    /**
     * View method
     *
     * @param string|null $id Customer Score id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $customerScore = $this->CustomerScores->get($id, [
            'contain' => ['Customers', 'Indicators'],
        ]);

        $this->set(compact('customerScore'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $customerScore = $this->CustomerScores->newEmptyEntity();
        if ($this->request->is('post')) {
            $customerScore = $this->CustomerScores->patchEntity($customerScore, $this->request->getData());
            if ($this->CustomerScores->save($customerScore)) {
                $this->Flash->success(__('The customer score has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The customer score could not be saved. Please, try again.'));
        }
        $customers = $this->CustomerScores->Customers->find('list', ['limit' => 200])->all();
        $indicators = $this->CustomerScores->Indicators->find('list', ['limit' => 200])->all();
        $this->set(compact('customerScore', 'customers', 'indicators'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Customer Score id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $customerScore = $this->CustomerScores->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $customerScore = $this->CustomerScores->patchEntity($customerScore, $this->request->getData());
            if ($this->CustomerScores->save($customerScore)) {
                $this->Flash->success(__('The customer score has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The customer score could not be saved. Please, try again.'));
        }
        $customers = $this->CustomerScores->Customers->find('list', ['limit' => 200])->all();
        $indicators = $this->CustomerScores->Indicators->find('list', ['limit' => 200])->all();
        $this->set(compact('customerScore', 'customers', 'indicators'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Customer Score id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $customerScore = $this->CustomerScores->get($id);
        if ($this->CustomerScores->delete($customerScore)) {
            $this->Flash->success(__('The customer score has been deleted.'));
        } else {
            $this->Flash->error(__('The customer score could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function calculate($customerId = null)
    {
        $this->request->allowMethod(['GET', 'POST']);

        if (!$customerId) {
            throw new BadRequestException(__('Customer ID is required'));
        }

        // Load the CustomerMetrics table to check if customer exists
        $customerMetrics = $this->getTableLocator()->get('CustomerMetrics');
        
        if (!$customerMetrics->exists(['customer_id' => $customerId])) {
            throw new NotFoundException(__('Customer not found'));
        }

        $service = new ScoringService();
        try {
            $result = $service->updateScoresPerCustomer($customerId);
            dd($result);
            $message = $result 
                ? __('Scores calculated successfully for customer {0}', $customerId)
                : __('Failed to calculate scores for customer {0}', $customerId);

            $this->set([
                'success' => $result,
                'message' => $message,
                'customer_id' => $customerId,
                '_serialize' => ['success', 'message', 'customer_id']
            ]);
        } catch (\Exception $e) {
            $this->response = $this->response->withStatus(500);
            $this->set([
                'success' => false,
                'message' => $e->getMessage(),
                'customer_id' => $customerId,
                '_serialize' => ['success', 'message', 'customer_id']
            ]);
        }
    }
}
