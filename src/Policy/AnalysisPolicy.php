<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Analysis;
use Authorization\IdentityInterface;

/**
 * Analysis policy
 */
class AnalysisPolicy extends BasePolicy
{
    /**
     * Check if $user can index Analysis
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @return bool
     */
    public function canIndex(IdentityInterface $user)
    {
        $additonalAllowedRoles = ['owner', 'analyst'];

        return $this->isAllowed($user, $additonalAllowedRoles);
    }
    
    /**
     * Check if $user can add Analysis
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Analysis $analysis
     * @return bool
     */
    public function canAdd(IdentityInterface $user)
    {
        $additonalAllowedRoles = ['owner', 'analyst'];

        return $this->isAllowed($user, $additonalAllowedRoles);
    }

    /**
     * Check if $user can edit Analysis
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Analysis $analysis
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Analysis $analysis)
    {
        $additonalAllowedRoles = ['owner'];

        return $this->isAllowed($user, $additonalAllowedRoles) || ($user->staff_no == $analysis->author_id);
    }

    /**
     * Check if $user can delete Analysis
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Analysis $analysis
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Analysis $analysis)
    {
        $additonalAllowedRoles = ['owner'];

        return  $this->isAllowed($user, $additonalAllowedRoles) || ($user->staff_no == $analysis->author_id);
    }

}
