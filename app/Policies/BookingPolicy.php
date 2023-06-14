<?php

namespace App\Policies;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BookingPolicy
{
    public function __construct(
        readonly private Response $response
    ){}

    /**
     * Determine whether the user can view a list bookings.
     */
    public function list(User $user, Booking $booking): Response
    {
        return $user->admin
        ? $this->response->allow()
        : $this->response->deny('You do not have access to bookings.');
    }

    /**
     * Determine whether the user can view a booking
     */
    public function view(User $user, Booking $booking): Response
    {
        return $user->admin
        ? $this->response->allow()
        : $this->response->deny('You do not have access to booking.');
    }
}
