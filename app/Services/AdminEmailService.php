<?php

namespace App\Services;

use App\Helpers\SettingHelper;
use Illuminate\Contracts\Mail\Mailer;
use App\Mail\Admin\BookingConfirmation;
use App\Values\Client;

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
    ){}

    /**
     * Send booking confirmation to admin
     */
    public function sendBookingConfirmation(array $booking) : void 
    {
        $this->mailer
            ->to($this->setting->adminEmail())
            ->send(new BookingConfirmation($booking));
    }
}