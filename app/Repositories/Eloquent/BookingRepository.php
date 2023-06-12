<?php

namespace App\Repositories\Eloquent;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Carbon\CarbonInterface;
use App\Models\Booking as Model;
use App\Values\BookingSorting;
use App\Repositories\Contracts\BookingRepository as RepositoryInterface;
use DateTime;

class BookingRepository implements RepositoryInterface
{
    public function __construct(
        /**
         * An instance of the booking eloquent model
         */
        private Model $model
    ){}

   /**
     * Create new booking
     * 
     * @param int      $clientId  Client ID
     * @param int      $vehicleId Vehicle ID
     * @param DateTime $date The booking date value object 
     */
    public function create(
        int $slotId, 
        int $clientId, 
        int $vehicleId, 
        DateTime $date
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
        ->when($date, fn($query) => $query->whereDate('bookings.start', $date))
        ->orderBy($sort->getColumn(), $sort->getDirection())
        ->paginate($perPage);
    }
}
