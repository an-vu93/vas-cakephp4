<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * OricohSeries Controller
 *
 * @property \App\Model\Table\OricohSeriesTable $OricohSeries
 * @method \App\Model\Entity\OricohSeries[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OricohSeriesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $oricohSeries = $this->OricohSeries->newEmptyEntity();;
        $this->Authorization->authorize($oricohSeries);
        $this->paginate = [
            'contain' => ['ProductTypes'],
        ];
        $oricohSeries = $this->paginate($this->OricohSeries);
        // dd($oricohSeries);
        $this->set(compact('oricohSeries'));
    }

    /**
     * View method
     *
     * @param string|null $id Oricoh Series id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $oricohSeries = $this->OricohSeries->get($id, [
            'contain' => ['ProductTypes'],
        ]);
        $this->Authorization->authorize($oricohSeries);

        $this->set(compact('oricohSeries'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $oricohSeries = $this->OricohSeries->newEmptyEntity();
        $this->Authorization->authorize($oricohSeries);
        if ($this->request->is('post')) {
            $oricohSeries = $this->OricohSeries->patchEntity($oricohSeries, $this->request->getData());
            if ($this->OricohSeries->save($oricohSeries)) {
                $this->Flash->success(__('The oricoh series has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The oricoh series could not be saved. Please, try again.'));
        }
        $productTypes = $this->OricohSeries->ProductTypes->find('list', ['limit' => 200])->all();
        $this->set(compact('oricohSeries', 'productTypes'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Oricoh Series id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $oricohSeries = $this->OricohSeries->get($id, [
            'contain' => [],
        ]);
        $this->Authorization->authorize($oricohSeries);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $oricohSeries = $this->OricohSeries->patchEntity($oricohSeries, $this->request->getData());
            if ($this->OricohSeries->save($oricohSeries)) {
                $this->Flash->success(__('The oricoh series has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The oricoh series could not be saved. Please, try again.'));
        }
        $productTypes = $this->OricohSeries->ProductTypes->find('list', ['limit' => 200])->all();
        $this->set(compact('oricohSeries', 'productTypes'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Oricoh Series id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $oricohSeries = $this->OricohSeries->get($id);
        if ($this->OricohSeries->delete($oricohSeries)) {
            $this->Flash->success(__('The oricoh series has been deleted.'));
        } else {
            $this->Flash->error(__('The oricoh series could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
