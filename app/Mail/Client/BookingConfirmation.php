<?php

namespace App\Mail\Client;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Values\{Client, Vehicle};
use DateTime;

class BookingConfirmation extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    readonly public Client   $client;
    readonly public Vehicle  $vehicle;
    readonly public DateTime $date;

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
    public function setBookingDate(DateTime $date) : void 
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
            markdown: 'emails.client.booking-confirmation',
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
