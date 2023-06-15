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
        readonly private Mailer $mailer,

        /**
         * Booking confirmation mailable
         */
        readonly private BookingConfirmation $mailable
    ){}

    /**
     * Send booking confirmation to Client
     */
    public function sendBookingConfirmation(
        int    $bookingId,
        Client $client
    ) : void {

        $this->mailable->setUp($bookingId);

        $this->mailer
            ->to($client->getEmail())
            ->send($this->mailable);
    }
}