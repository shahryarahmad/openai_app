<?php

namespace App\Policies;

use App\Models\User;

class AdminPolicy
{
    public function view(User $user)
    {
        return $user->hasRole('admin');
    }

    public function create(User $user)
    {
        return $user->hasRole('admin');
    }
}
