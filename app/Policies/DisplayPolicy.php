<?php

namespace App\Policies;

use App\Models\Display;
use App\Models\User;

/**
 * Policy: DisplayPolicy
 *
 * Restricts display access to the owner user.
 */
class DisplayPolicy
{
    /**
     * Determine whether the user can access the display.
     *
     * @param User $user
     * @param Display $display
     * @return bool
     */
    public function view(User $user, Display $display): bool
    {
        return $user->id === $display->user_id;
    }

    public function update(User $user, Display $display): bool
    {
        return $user->id === $display->user_id;
    }

    public function delete(User $user, Display $display): bool
    {
        return $user->id === $display->user_id;
    }
}
