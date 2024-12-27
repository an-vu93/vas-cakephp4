<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * UserRoles Controller
 *
 * @property \App\Model\Table\UserRolesTable $UserRoles
 * @method \App\Model\Entity\UserRole[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UserRolesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $userRole = $this->UserRoles->newEmptyEntity();
        $this->Authorization->authorize($userRole);
        $userRoles = $this->paginate($this->UserRoles);

        $this->set(compact('userRoles'));
    }

    /**
     * View method
     *
     * @param string|null $id User Role id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $userRole = $this->UserRoles->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('userRole'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $userRole = $this->UserRoles->newEmptyEntity();
        $this->Authorization->authorize($userRole);
        if ($this->request->is('post')) {
            $userRole = $this->UserRoles->patchEntity($userRole, $this->request->getData());
            if ($this->UserRoles->save($userRole)) {
                $this->Flash->success(__('The user role has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user role could not be saved. Please, try again.'));
        }
        $this->set(compact('userRole'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User Role id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userRole = $this->UserRoles->get($id, [
            'contain' => [],
        ]);
        $this->Authorization->authorize($userRole);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userRole = $this->UserRoles->patchEntity($userRole, $this->request->getData());
            if ($this->UserRoles->save($userRole)) {
                $this->Flash->success(__('The user role has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user role could not be saved. Please, try again.'));
        }
        $this->set(compact('userRole'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User Role id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $userRole = $this->UserRoles->get($id);
        $this->Authorization->authorize($userRole);
        if ($this->UserRoles->delete($userRole)) {
            $this->Flash->success(__('ユーザー権限が削除されました。'));
        } else {
            $this->Flash->error(__('ユーザー権限が削除出来ませんでした。もう一度お試しください。'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
