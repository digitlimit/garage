<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Routing\UrlGenerator;

use App\Values\{Client, Vehicle, BookingDate};

class AdminBookingConfirmation extends Mailable
{
    use Queueable, SerializesModels, ShouldQueue;

    public string $url;

    /**
     * Create a new message instance.
     */
    public function __construct(
        readonly private int          $bookingId,
        readonly public  Client       $client,
        readonly public  Vehicle      $vehicle,
        readonly public  BookingDate  $date,
        readonly private UrlGenerator $urlGenerator
    ){
        $this->url = $this->urlGenerator
            ->route('bookings.view', $this->bookingId);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Booking Confirmation',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.admin-booking-confirmation',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
