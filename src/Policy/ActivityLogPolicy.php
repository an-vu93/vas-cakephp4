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
    /**
     * Check if $user can view ActivityLog
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\ActivityLog $activityLog
     * @return bool
     */
    public function canView(IdentityInterface $user, ActivityLog $activityLog)
    {
    }
}
