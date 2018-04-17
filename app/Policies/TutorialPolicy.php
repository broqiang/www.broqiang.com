<?php

namespace App\Policies;

use App\Models\Tutorial;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TutorialPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
    }

    public function isMember(User $user, Tutorial $tutorial)
    {
        if ($tutorial->isPublic()) {
            return true;
        }
        return $user->member_level > 0;
    }

}
