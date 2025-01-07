<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ActivityLog Entity
 *
 * @property int $id
 * @property int $employee_number
 * @property string $employee_name
 * @property string $action
 * @property string $controller
 * @property string $type
 * @property string $description
 * @property string $ip_address
 * @property \Cake\I18n\FrozenTime $created
 */
class ActivityLog extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'employee_number' => true,
        'employee_name' => true,
        'action' => true,
        'controller' => true,
        'type' => true,
        'description' => true,
        'ip_address' => true,
        'created' => true,
    ];
}
