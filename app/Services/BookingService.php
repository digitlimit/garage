<?php

namespace App\Services;

use App\Repositories\Contracts\BookingRepository;
use App\Repositories\Contracts\ClientRepository;
use App\Repositories\Contracts\VehicleRepository;
use App\Values\BookingSorting;
use App\Values\Client;
use App\Values\Vehicle;
use Carbon\CarbonInterface;
use Exception;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class BookingService
{
    public function __construct(
        readonly private BookingRepository $booking,
        readonly private ClientRepository $client,
        readonly private VehicleRepository $vehicle,
        readonly private ClientEmailService $clientEmail,
        readonly private AdminEmailService $adminEmail,
        readonly private Repository $config
    ) {
    }

    public function find(int $bookingId)
    {
        return $this
            ->booking
            ->findWithRelated($bookingId);
    }

    /**
     * Fetch list of booking
     */
    public function list(
        string $sortColumn,
        string $sortDirection,
        int $perPage,
        CarbonInterface $date = null
    ): LengthAwarePaginator {

        $sorting = new BookingSorting($sortColumn, $sortDirection);

        if ($date) {
            return $this
                ->booking
                ->filterByDate($date, $sorting, $perPage);
        }

        return $this
            ->booking
            ->list($sorting, $perPage);
    }

    /**
     * Create new booking record
     *
     * @return int The booking ID
     *
     * @throws Exception
     */
    public function addNew(
        int $slotId,
        Client $client,
        Vehicle $vehicle,
        CarbonInterface $date
    ): int|null {

        DB::beginTransaction();

        // attempt to create a client
        $clientId = $this->client->firstOrCreate($client);

        if (empty($clientId)) {
            throw new Exception('Unable to create client');
        }

        // attempt to create a vehicle
        $vehicleId = $this->vehicle->firstOrCreate($vehicle);

        if (empty($vehicleId)) {
            throw new Exception('Unable to create vehicle');
        }

        // attempt to create booking
        $bookingId = $this
            ->booking
            ->create($slotId, $clientId, $vehicleId, $date);

        DB::commit();

        // send emails to client and admin
        if ($bookingId) {
            $booking = $this
                ->booking
                ->findWithRelated($bookingId)
                ->toArray();

            $this->clientEmail
                ->sendBookingConfirmation($booking);

            $this->adminEmail
                ->sendBookingConfirmation($booking);
        }

        return $bookingId;
    }
}
