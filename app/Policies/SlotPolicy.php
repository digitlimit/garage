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
    public function closeSlot(User $user): bool
    {
        return $user->admin
        ? $this->allow()
        : $this->deny();
    }

    /**
     * Determine whether the user can open a closed slot
     *
     * @throws \App\Exceptions\PolicyException;
     */
    public function openOpen(User $user): bool
    {
        return $user->admin
        ? $this->allow()
        : $this->deny();
    }

    /**
     * Determine whether the user can close a date.
     *
     * @throws \App\Exceptions\PolicyException;
     */
    public function closeDate(User $user): bool
    {
        return $user->admin
        ? $this->allow()
        : $this->deny();
    }

    /**
     * Determine whether the user can open a closed date
     *
     * @throws \App\Exceptions\PolicyException;
     */
    public function openDate(User $user): bool
    {
        return $user->admin
        ? $this->allow()
        : $this->deny();
    }
}
