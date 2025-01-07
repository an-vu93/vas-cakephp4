<?php
declare(strict_types=1);

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

class ActivityLogComponent extends Component
{
    public function logActivity($type = null, $description = null)
    {
        $request = $this->getController()->getRequest();
        $session = $request->getSession();
        
        $logTable = TableRegistry::getTableLocator()->get('ActivityLogs');

        $data = [
            'employee_number' => $session->read('Auth.staff_no'),
            'employee_name' => $session->read('Auth.name'),
            'action' => $request->getParam('action'),
            'controller' => $request->getParam('controller'),
            'type' => $type,
            'description' => $description,
            'ip_address' => $request->clientIp()
        ];
       
        $logEntry = $logTable->newEntity($data);
       
        return $logTable->save($logEntry);
    }
}