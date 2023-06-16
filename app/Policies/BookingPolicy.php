<?php

namespace App\Policies;

use App\Models\User;

class BookingPolicy extends BasePolicy
{
    /**
     * Determine whether the user can view a list bookings.
     *
     * @throws \App\Exceptions\PolicyException;
     */
    public function list(User $user): bool
    {info($user);
        return $user->admin
        ? $this->allow()
        : $this->deny();
    }
}
