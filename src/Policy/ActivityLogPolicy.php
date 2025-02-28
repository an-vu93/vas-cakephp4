<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\ActivityLog;
use Authorization\IdentityInterface;

/**
 * ActivityLog policy
 */
class ActivityLogPolicy extends BasePolicy
{
    public function canIndex(IdentityInterface $user)
    {
        $additonalAllowedRoles = ['owner', 'analyst'];

        return $this->isAllowed($user, $additonalAllowedRoles);
    }
}
