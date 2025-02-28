<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\OricohSeries;
use Authorization\IdentityInterface;

/**
 * OricohSeries policy
 */
class OricohSeriesPolicy extends BasePolicy
{
    /**
     * Check if $user can add OricohSeries
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\OricohSeries $oricohSeries
     * @return bool
     */
    public function canAdd(IdentityInterface $user)
    {
        $additonalAllowedRoles = ['owner'];

        return $this->isAllowed($user, $additonalAllowedRoles);
    }

    /**
     * Check if $user can edit OricohSeries
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\OricohSeries $oricohSeries
     * @return bool
     */
    public function canEdit(IdentityInterface $user, OricohSeries $oricohSeries)
    {
        $additonalAllowedRoles = ['owner', 'analyst'];

        return $this->isAllowed($user, $additonalAllowedRoles);
    }

    /**
     * Check if $user can delete OricohSeries
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\OricohSeries $oricohSeries
     * @return bool
     */
    public function canDelete(IdentityInterface $user, OricohSeries $oricohSeries)
    {
        $additonalAllowedRoles = ['owner', 'analyst'];

        return $this->isAllowed($user, $additonalAllowedRoles);
    }
}
