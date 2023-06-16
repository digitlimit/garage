<?php

namespace App\Policies;

use App\Models\User;

class SlotPolicy extends BasePolicy
{
    /**
     * Determine whether the user can close a slot.
     * 
     * @throws \App\Exceptions\PolicyException;
     */
    public function close(User $user) : bool
    {
        return $user->admin
        ? $this->allow()
        : $this->deny('You do not have close access this slot.');
    }

    /**
     * Determine whether the user can open a closed slot
     * 
     * @throws \App\Exceptions\PolicyException;
     */
    public function open(User $user) : bool
    {
        return $user->admin
        ? $this->allow()
        : $this->deny('You do not have open access this slot.');
    }
}
