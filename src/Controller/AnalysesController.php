<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Analyses Controller
 *
 * @method \App\Model\Entity\Analysis[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AnalysesController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadModel('Indicators');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $analyses = $this->paginate($this->Analyses);

        $this->set(compact('analyses'));
    }

    /**
     * View method
     *
     * @param string|null $id Analysis id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $analysis = $this->Analyses->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('analysis'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $analysis = $this->Analyses->newEmptyEntity();
        if ($this->request->is('post')) {
            $analysis = $this->Analyses->patchEntity($analysis, $this->request->getData(), [
                'associated' => ['IndicatorWeights']
            ]);

            if ($this->Analyses->save($analysis, ['associated' => ['IndicatorWeights']])) {
                $this->Flash->success(__('The analysis has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The analysis could not be saved. Please, try again.'));
        }
        $indicators = $this->Indicators->find('list')->toArray();
       
        $this->set(compact('analysis', 'indicators'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Analysis id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $analysis = $this->Analyses->get($id, [
            'contain' => ['IndicatorWeights'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $analysis = $this->Analyses->patchEntity($analysis, $this->request->getData(), [
                'associated' => ['IndicatorWeights']
            ]);
            if ($this->Analyses->save($analysis, ['associated' => ['IndicatorWeights']])) {
                $this->Flash->success(__('The analysis has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The analysis could not be saved. Please, try again.'));
        }
        $indicators = $this->Indicators->find('list')->toArray();
       
        $this->set(compact('analysis', 'indicators'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Analysis id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $analysis = $this->Analyses->get($id);
        if ($this->Analyses->delete($analysis)) {
            $this->Flash->success(__('The analysis has been deleted.'));
        } else {
            $this->Flash->error(__('The analysis could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
