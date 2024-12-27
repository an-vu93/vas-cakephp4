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
        $analysis = $this->Analyses->newEmptyEntity();
        $this->Authorization->authorize($analysis);
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
        $this->Authorization->authorize($analysis);
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
        $this->Authorization->authorize($analysis);
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
        $this->Authorization->authorize($analysis);
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
        $this->Authorization->authorize($analysis);
        if ($this->Analyses->delete($analysis)) {
            $this->Flash->success(__('解析ツールが削除されました。'));
        } else {
            $this->Flash->error(__('解析ツールが削除出来ませんでした。もう一度お試しください。'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
