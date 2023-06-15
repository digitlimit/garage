<?php

namespace App\Mail\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Routing\UrlGenerator;
use App\Repositories\Contracts\BookingRepository;

class BookingConfirmation extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public string $url;
    public $booking;

    /**
     * Create a new message instance.
     */
    public function __construct(
        readonly private UrlGenerator $urlGenerator,
        readonly private BookingRepository $bookingRepository
    ){}

    /**
     * Setup booking props
     */
    public function setUp(int $bookingId) : void 
    {
        $this->booking = $this->bookingRepository->find($bookingId);

        $this->url = $this
            ->urlGenerator
            ->route('bookings.view', $bookingId);
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
            markdown: 'emails.admin.booking-confirmation',
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
