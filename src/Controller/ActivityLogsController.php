<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * ActivityLogs Controller
 *
 * @property \App\Model\Table\ActivityLogsTable $ActivityLogs
 * @method \App\Model\Entity\ActivityLog[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ActivityLogsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $activityLog = $this->ActivityLogs->newEmptyEntity();
        $this->Authorization->authorize($activityLog);
        $activityLogs = $this->paginate($this->ActivityLogs);

        $this->set(compact('activityLogs'));
    }

    /**
     * View method
     *
     * @param string|null $id Activity Log id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $activityLog = $this->ActivityLogs->get($id, [
            'contain' => [],
        ]);
        $this->Authorization->authorize($activityLog);

        $this->set(compact('activityLog'));
    }
}
