<?php

namespace App\Repositories\Eloquent;

use Carbon\CarbonInterface;
use App\Values\BookingSorting;
use App\Models\Booking as Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Repositories\Contracts\BookingRepository as RepositoryInterface;

class BookingRepository implements RepositoryInterface
{
    public function __construct(
        /**
         * An instance of the booking eloquent model
         */
        private Model $model
    ){}

    /**
     * Fetch a booking by ID
     */
    public function find(int $bookingId) : mixed
    {
        return $this
            ->model
            ->find($bookingId);
    }

   /**
     * Create new booking
     * 
     * @param int      $clientId  Client ID
     * @param int      $vehicleId Vehicle ID
     * @param CarbonInterface; $date The booking date value object 
     */
    public function create(
        int $slotId, 
        int $clientId, 
        int $vehicleId, 
        CarbonInterface $date
    ) : int {
        $booking = $this
            ->model
            ->create([
                'client_id'  => $clientId,
                'vehicle_id' => $vehicleId,
                'slot_id'    => $slotId,
                'date'       => $date
            ]);

        return $booking->id;
    }

    /**
     * Fetch a paginated collection of upcoming bookings.
     * 
     * @param BookingSorting $sort    Booking sorting value object
     * @param int            $perPage The number of records per page, default 15
     */
    public function list(
        BookingSorting  $sort,
        int             $perPage=15
    ): LengthAwarePaginator {

        return $this->model
        ->query()
        ->list()
        ->orderBy($sort->getColumn(), $sort->getDirection())
        ->paginate($perPage);
    }

    /**
     * Filter booking by date
     * 
     * @param CarbonInterface $date    The date to filter to
     * @param BookingSorting  $sort    Booking sorting value object
     * @param int             $perPage The number of records per page, default 15
     */
    public function filterByDate(
        CarbonInterface $date,
        BookingSorting  $sort,
        int             $perPage=15
    ): LengthAwarePaginator {

        return $this->model
        ->query()
        ->list()
        ->when($date, fn($query) => $query->whereDate('bookings.date', $date))
        ->orderBy($sort->getColumn(), $sort->getDirection())
        ->paginate($perPage);
    }
}
