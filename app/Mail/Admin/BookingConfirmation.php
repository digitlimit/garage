<?php

namespace App\Mail\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Routing\UrlGenerator;

use App\Values\{Client, Vehicle, BookingDate};

class BookingConfirmation extends Mailable
{
    use Queueable, SerializesModels, ShouldQueue;

    readonly public  string       $url;
    readonly public  Client       $client;
    readonly public  Vehicle      $vehicle;
    readonly public  BookingDate  $date;

    /**
     * Create a new message instance.
     */
    public function __construct(
        readonly private UrlGenerator $urlGenerator
    ){}

    /**
     * Set url
     */
    public function setUrl(int $bookingId) : void 
    {
        $this->urlGenerator->route('bookings.view', $bookingId);
    }

    /**
     * Set client
     */
    public function setClient(Client $client) : void 
    {
        $this->client = $client;
    }

    /**
     * Set vehicle
     */
    public function setVehicle(Vehicle $vehicle) : void 
    {
        $this->vehicle = $vehicle;
    }

    /**
     * Set Booking Date
     */
    public function setBookingDate(BookingDate $date) : void 
    {
        $this->date = $date;
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
