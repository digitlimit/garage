<?php

namespace App\Policies;

use App\Models\Slot;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SlotPolicy
{
    public function __construct(
        readonly private Response $response
    ){}

    /**
     * Determine whether the user can close a slot.
     */
    public function close(User $user, Slot $slot): Response
    {
        return $user->admin
        ? $this->response->allow()
        : $this->response->deny('You do not have access this slot.');
    }

    /**
     * Determine whether the user can open a closed slot
     */
    public function open(User $user, Slot $slot): Response
    {
        return $user->admin
        ? $this->response->allow()
        : $this->response->deny('You do not have access this slot.');
    }
}
