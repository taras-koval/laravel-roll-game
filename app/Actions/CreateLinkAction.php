<?php

namespace App\Actions;

use App\Models\Link;
use App\Models\User;

/** Tests @see CreateLinkActionTest */
class CreateLinkAction
{
    public function __invoke(User $user): Link
    {
        $user->links()->where('active', true)->update(['active' => false]);

        return $user->links()->create();
    }
}
