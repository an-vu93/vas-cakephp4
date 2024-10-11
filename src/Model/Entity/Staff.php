<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Staff Entity
 *
 * @property int $id
 * @property int $team_id
 * @property string $name
 * @property string|null $kana
 * @property string $email
 * @property string|null $login_id
 * @property string|null $login_pw
 * @property int $retire_flg
 * @property string $remarks
 */
class Staff extends Entity
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
        'team_id' => true,
        'name' => true,
        'kana' => true,
        'email' => true,
        'login_id' => true,
        'login_pw' => true,
        'retire_flg' => true,
        'remarks' => true,
    ];
}
