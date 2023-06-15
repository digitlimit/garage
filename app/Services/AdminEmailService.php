<?php

namespace App\Services;

use App\Helpers\SettingHelper;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Contracts\Config\Repository;
use App\Mail\Admin\BookingConfirmation;

class AdminEmailService
{
    public function __construct(
        /**
         * Mail client contract
         */
        readonly private Mailer $mailer,

        /**
         * Settings
         */
        readonly private SettingHelper $setting,

        /**
         * Booking confirmation mailable
         */
        readonly private BookingConfirmation $mailable
    ){}

    /**
     * Send booking confirmation to admin
     */
    public function sendBookingConfirmation(int $bookingId) : void 
    {

        $this->mailable->setUp($bookingId);

        $this->mailer
            ->to($this->setting->adminEmail())
            ->send($this->mailable);
    }
}