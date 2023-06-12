<?php

namespace App\Services;

use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Contracts\Config\Repository;
use App\Mail\Admin\BookingConfirmation;
use App\Values\{Client, Vehicle, BookingDate};

class AdminEmailService
{
    public function __construct(
        /**
         * Mail client contract
         */
        readonly private Mailer $mailer,

        /**
         * Configuration 
         */
        readonly private Repository $config,

        /**
         * Booking confirmation mailable
         */
        readonly private BookingConfirmation $mailable
    ){}

    /**
     * Send booking confirmation to admin
     */
    public function sendBookingConfirmation(
        int         $bookingId,
        Client      $client, 
        Vehicle     $vehicle, 
        BookingDate $date
    ) : void {

        $adminEmail = $this->config
            ->get('app.admin.email');

        $this->mailable->setUrl($bookingId);
        $this->mailable->setClient($client);
        $this->mailable->setVehicle($vehicle);
        $this->mailable->setBookingDate($date);

        $this->mailer
            ->to($adminEmail)
            ->send($this->mailable);
    }
}