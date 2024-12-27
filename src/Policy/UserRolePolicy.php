<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\UserRole;
use Authorization\IdentityInterface;

/**
 * UserRole policy
 */
class UserRolePolicy extends BasePolicy
{
    /**
     * Check if $user can add UserRole
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\UserRole $userRole
     * @return bool
     */
    public function canAdd(IdentityInterface $user)
    {
        return $this->isAllowed($user, ['owner']);
    }

    /**
     * Check if $user can edit UserRole
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\UserRole $userRole
     * @return bool
     */
    public function canEdit(IdentityInterface $user, UserRole $userRole)
    {
        return $this->isAllowed($user, ['owner']);
    }

    /**
     * Check if $user can delete UserRole
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\UserRole $userRole
     * @return bool
     */
    public function canDelete(IdentityInterface $user, UserRole $userRole)
    {
        return $this->isAllowed($user, ['owner']);
    }

    /**
     * Check if $user can view UserRole
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\UserRole $userRole
     * @return bool
     */
    public function canView(IdentityInterface $user, UserRole $userRole)
    {
        return $this->isAllowed($user, ['root', 'owner']);
    }
}
