<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * DevSettings Controller
 *
 * @method \App\Model\Entity\DevSetting[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DevSettingsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();
       
    }

    /**
     * View method
     *
     * @param string|null $id Dev Setting id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $devSetting = $this->DevSettings->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('devSetting'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $devSetting = $this->DevSettings->newEmptyEntity();
        if ($this->request->is('post')) {
            $devSetting = $this->DevSettings->patchEntity($devSetting, $this->request->getData());
            if ($this->DevSettings->save($devSetting)) {
                $this->Flash->success(__('The dev setting has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The dev setting could not be saved. Please, try again.'));
        }
        $this->set(compact('devSetting'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Dev Setting id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $devSetting = $this->DevSettings->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $devSetting = $this->DevSettings->patchEntity($devSetting, $this->request->getData());
            if ($this->DevSettings->save($devSetting)) {
                $this->Flash->success(__('The dev setting has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The dev setting could not be saved. Please, try again.'));
        }
        $this->set(compact('devSetting'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Dev Setting id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $devSetting = $this->DevSettings->get($id);
        if ($this->DevSettings->delete($devSetting)) {
            $this->Flash->success(__('The dev setting has been deleted.'));
        } else {
            $this->Flash->error(__('The dev setting could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
