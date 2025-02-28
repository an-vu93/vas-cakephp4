<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Indicator;
use Authorization\IdentityInterface;

/**
 * Indicator policy
 */
class IndicatorPolicy extends BasePolicy
{
    /**
     * Check if $user can edit Indicator
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Indicator $indicator
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Indicator $indicator)
    {
        $additonalAllowedRoles = ['owner'];

        return $this->isAllowed($user, $additonalAllowedRoles);
    }

    /**
     * Check if $user can delete Indicator
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Indicator $indicator
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Indicator $indicator)
    {
        $additonalAllowedRoles = ['owner'];

        return $this->isAllowed($user, $additonalAllowedRoles);
    }
}
