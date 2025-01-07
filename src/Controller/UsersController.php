<?php
declare(strict_types=1);

namespace App\Controller;

use Authentication\Identity;

/**
 * Users Controller
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('ActivityLog');
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // Configure the login action to not require authentication, preventing
        // the infinite redirect loop issue
        $this->Authentication->addUnauthenticatedActions(['login']);
    }

    public function login()
    {
        $this->Authorization->skipAuthorization();

        $this->viewBuilder()->setLayout('search');
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result && $result->isValid()) {

            // Get current identity
            $identity = $this->Authentication->getIdentity();   
            $identityData = $identity->getOriginalData();
          
            $identityData['user_role'] = $this->checkRole($identityData['staff_no'], $identityData['email']);

            $newIdentity = new Identity($identityData);
           
            $this->Authentication->setIdentity($newIdentity);

            // redirect to /search after login success
            $redirect = $this->request->getQuery('redirect', [
                'controller' => 'Search',
                'action' => 'index',
            ]);

            $this->ActivityLog->logActivity('ログイン', 'ログイン');

            return $this->redirect($redirect);
        }
        // display error if user submitted and authentication failed
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('ログインID又はパスワードが間違っています！'));
        }
    }


    public function logout()
    {
        $this->Authorization->skipAuthorization();

        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result && $result->isValid()) {
            $this->Authentication->logout();
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }

        $this->ActivityLog->logActivity('ログアウト', 'ログアウト');
    }

    public function checkRole($employeeNumber, $loginId)
    {
        // Check the role in the local database
        $userRolesTable = $this->fetchTable('UserRoles');
        $userRole = $userRolesTable->find()
            ->where(['employee_number' => $employeeNumber, 'email' => $loginId])
            ->first();

        if ($userRole) {
            return $userRole->role;
        }

        return 'general'; // Default role if no record exists
    }

}
