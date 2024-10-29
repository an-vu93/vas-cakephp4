<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * IndicatorWeights Controller
 *
 * @property \App\Model\Table\IndicatorWeightsTable $IndicatorWeights
 * @method \App\Model\Entity\IndicatorWeight[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class IndicatorWeightsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Analyses', 'Indicators'],
        ];
        $indicatorWeights = $this->paginate($this->IndicatorWeights);

        $this->set(compact('indicatorWeights'));
    }

    /**
     * View method
     *
     * @param string|null $id Indicator Weight id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $indicatorWeight = $this->IndicatorWeights->get($id, [
            'contain' => ['Analyses', 'Indicators'],
        ]);

        $this->set(compact('indicatorWeight'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $indicatorWeight = $this->IndicatorWeights->newEmptyEntity();
        if ($this->request->is('post')) {
            $indicatorWeight = $this->IndicatorWeights->patchEntity($indicatorWeight, $this->request->getData());
            if ($this->IndicatorWeights->save($indicatorWeight)) {
                $this->Flash->success(__('The indicator weight has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The indicator weight could not be saved. Please, try again.'));
        }
        $analyses = $this->IndicatorWeights->Analyses->find('list', ['limit' => 200])->all();
        $indicators = $this->IndicatorWeights->Indicators->find('list', ['limit' => 200])->all();
        $this->set(compact('indicatorWeight', 'analyses', 'indicators'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Indicator Weight id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $indicatorWeight = $this->IndicatorWeights->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $indicatorWeight = $this->IndicatorWeights->patchEntity($indicatorWeight, $this->request->getData());
            if ($this->IndicatorWeights->save($indicatorWeight)) {
                $this->Flash->success(__('The indicator weight has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The indicator weight could not be saved. Please, try again.'));
        }
        $analyses = $this->IndicatorWeights->Analyses->find('list', ['limit' => 200])->all();
        $indicators = $this->IndicatorWeights->Indicators->find('list', ['limit' => 200])->all();
        $this->set(compact('indicatorWeight', 'analyses', 'indicators'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Indicator Weight id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $indicatorWeight = $this->IndicatorWeights->get($id);
        if ($this->IndicatorWeights->delete($indicatorWeight)) {
            $this->Flash->success(__('The indicator weight has been deleted.'));
        } else {
            $this->Flash->error(__('The indicator weight could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
