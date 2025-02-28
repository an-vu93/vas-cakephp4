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
}
