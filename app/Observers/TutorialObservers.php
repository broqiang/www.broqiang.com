<?php

namespace App\Observers;

use App\Models\Tutorial;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class TutorialObservers
{
    public function deleting(Tutorial $tutorial)
    {
        $tutorial->articles()->delete();
    }
}
