<?php

namespace App\Services;

use Illuminate\Contracts\Mail\Mailer;
use App\Mail\Client\BookingConfirmation;
use App\Values\Client;
use DateTime;

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
    public function sendBookingConfirmation(Client $client, DateTime $date)
    {

        $this->mailable->setClient($client);
        $this->mailable->setDateTime($date);

        $this->mailer
            ->to($client->getEmail())
            ->send($this->mailable);
    }
}