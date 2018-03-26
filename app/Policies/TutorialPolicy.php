<?php

namespace App\Policies;

use App\Models\Tutorial;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TutorialPolicy
{
    use HandlesAuthorization;

    public function index(User $user)
    {
        if ($user->is_admin) {
            return true;
        }

        return $user->member_level > 0;
    }

    public function show(User $user, Tutorial $tutorial)
    {
        return $this->checkAuthorization($user, $tutorial);
    }

    protected function checkAuthorization(User $user, Tutorial $tutorial)
    {
        if ($user->is_admin || $tutorial->auth) {
            return true;
        }

        return $user->member_level > 0;
    }

}
