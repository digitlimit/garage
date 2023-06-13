<?php

namespace App\Services;

use Illuminate\Contracts\Mail\Mailer;
use App\Mail\Client\BookingConfirmation;
use App\Values\Client;
use App\Values\Vehicle;
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
    public function sendBookingConfirmation(
        Client   $client, 
        Vehicle  $vehicle, 
        DateTime $date
    ) : void {

        $this->mailable->setClient($client);
        $this->mailable->setBookingDate($date);
        $this->mailable->setVehicle($vehicle);

        $this->mailer
            ->to($client->getEmail())
            ->send($this->mailable);
    }
}