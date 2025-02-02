<?php

namespace App\Policies;

use App\Models\Item;
use App\Models\User;

class ItemPolicy
{
    public function update(User $user, Item $item): bool
    {
        return $user->id === $item->user_id || $user->is_admin;
    }

    public function delete(User $user, Item $item): bool
    {
        return $user->id === $item->user_id || $user->is_admin;
    }
}