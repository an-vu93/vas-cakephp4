<?php
declare(strict_types=1);

namespace App\Policy;

use Authorization\IdentityInterface;

class BasePolicy
{
    protected array $defaultRoles = ['root'];

    public function canIndex(IdentityInterface $user)
    {
        $additonalAllowedRoles = ['owner'];

        return $this->isAllowed($user, $additonalAllowedRoles);
    }

    public function canAdd(IdentityInterface $user)
    {
        return $this->isAllowed($user);
    }

     /**
     * Check if $user can perform an action based on roles
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param array $allowedRoles Additional roles allowed to perform the action.
     * @return bool
     */
    protected function isAllowed(IdentityInterface $user, array $additonalAllowedRoles = []): bool
    {
        // Merge default roles with additional roles, keeping unique elements
        $mergedRoles = array_unique(array_merge($this->defaultRoles, $additonalAllowedRoles));

        return in_array($user->user_role, $mergedRoles, true);
    }
}
