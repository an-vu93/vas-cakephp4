<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\CustomerProfile;
use Authorization\IdentityInterface;

/**
 * CustomerProfile policy
 */
class CustomerProfilePolicy extends BasePolicy
{
    public function canEdit(IdentityInterface $user, CustomerProfile $customerProfile)
    {
        $additonalAllowedRoles = ['owner'];

        return $this->isAllowed($user, $additonalAllowedRoles);
    }
}
