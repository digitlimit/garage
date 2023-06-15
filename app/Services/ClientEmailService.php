<?php

namespace App\Services;

use App\Values\Client;
use Illuminate\Contracts\Mail\Mailer;
use App\Mail\Client\BookingConfirmation;

class ClientEmailService
{
    public function __construct(
        /**
         * Email client contract
         */
        readonly private Mailer $mailer
    ){}

    /**
     * Send booking confirmation to Client
     */
    public function sendBookingConfirmation(array $booking) : void 
    {
        $this->mailer
            ->to($booking['email'])
            ->send(new BookingConfirmation($booking));
    }
}