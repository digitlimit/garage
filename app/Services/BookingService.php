<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Config\Repository;
use App\Repositories\Contracts\{BookingRepository, ClientRepository, VehicleRepository};
use App\Services\{ClientEmailService, AdminEmailService};
use App\Values\{Client, Vehicle, BookingDate};

class BookingService
{
    public function __construct(
        readonly private BookingRepository  $booking,
        readonly private ClientRepository   $client,
        readonly private VehicleRepository  $vehicle,
        readonly private ClientEmailService $clientEmail,
        readonly private AdminEmailService  $adminEmail,
        readonly private Repository         $config
    ){}

    /**
     * Create new booking record
     * 
     * @return int The booking ID
     * @throws Exception
     */
    public function addNew(
        Client      $client,
        Vehicle     $vehicle,
        BookingDate $bookingDate
    ) : int|null {

        DB::beginTransaction();

        // attempt to create a client
        $clientId = $this->client->firstOrCreate($client);

        if(empty($clientId)) {
            throw new Exception('Unable to create client');
        }

        // attempt to create a vehicle
        $vehicleId = $this->vehicle->firstOrCreate($vehicle);

        if(empty($vehicleId)) {
            throw new Exception('Unable to create vehicle');
        }

        // attempt to create booking
        $bookingId = $this
            ->booking
            ->create($clientId, $vehicleId, $bookingDate);
            
        DB::commit();

        // send emails to client and admin
        if($bookingId) {
            $this->emailClient($client, $bookingDate);
            $this->emailAdmin($bookingId, $client, $vehicle, $bookingDate);
        }

        return $bookingId;
    }

    /**
     * Send booking confirmation email to the client
     */
    public function emailClient(Client $client, BookingDate $bookingDate): void
    {
        $this->clientEmail
        ->sendBookingConfirmation($client, $bookingDate);
    }

    /**
     * Send booking confirmation email to the admin
     */
    public function emailAdmin(
        int         $bookingId, 
        Client      $client, 
        Vehicle     $vehicle, 
        BookingDate $bookingDate
    ): void {
        $this->adminEmail
        ->sendBookingConfirmation($bookingId, $client, $vehicle, $bookingDate);
    }
}
