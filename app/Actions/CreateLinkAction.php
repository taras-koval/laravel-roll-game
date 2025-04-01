<?php

namespace App\Actions;

use App\Models\Link;
use App\Models\User;

class CreateLinkAction
{
    public function __invoke(User $user): Link
    {
        $user->links()->update(['active' => false]);

        return $user->links()->create();
    }
}
