<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ClosedDate;
use Illuminate\Auth\Access\Response;

class ClosedDatePolicy
{
    public function __construct(
        readonly private Response $response
    ){}

    /**
     * Determine whether the user can close a slot.
     */
    public function close(User $user, ClosedDate $closed): Response
    {
        return $user->admin
        ? $this->response->allow()
        : $this->response->deny('You do not have access to closed date.');
    }

    /**
     * Determine whether the user can open a closed slot.
     */
    public function open(User $user, ClosedDate $closed): Response
    {
        return $user->admin
        ? $this->response->allow()
        : $this->response->deny('You do not have access to closed date.');
    }
}
