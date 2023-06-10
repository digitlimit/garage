<?php

namespace App\Repositories\Eloquent;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Carbon\CarbonInterface;
use App\Models\Booking as Model;
use App\Values\BookingDate;
use App\Values\BookingSorting;
use App\Repositories\Contracts\BookingRepository as RepositoryInterface;

class BookingRepository implements RepositoryInterface
{
    public function __construct(private Model $model)
    {}

   /**
     * Create new booking
     * 
     * @param int         $clientId  Client ID
     * @param int         $vehicleId Vehicle ID
     * @param BookingDate $date The booking date value object 
     */
    public function create(int $clientId, int $vehicleId, BookingDate $date) : int
    {
        $booking = $this
            ->model
            ->create([
                'client_id'  => $clientId,
                'vehicle_id' => $vehicleId,
                'start'      => $date->getStart(),
                'end'        => $date->getEnd()
            ]);

        return $booking->id;
    }

    /**
     * Fetch a paginated collection of upcoming bookings.
     * 
     * @param array  $filters        An optional array of filters
     * @param int    $perPage        The number of records per page, default 15
     * @param string $orderDirection Ordering direction ASC|DESC, default DESC
     */
    public function list(
        BookingSorting  $sort,
        int             $perPage=15
    ): LengthAwarePaginator {
        
        return $this->model
        ->query()
        ->upcoming()
        ->orderBy($sort->getColumn(), $sort->getDirection())
        ->paginate($perPage);
    }

    public function filterByDate(
        CarbonInterface $date,
        BookingSorting  $sort,
        int             $perPage=15
    ): LengthAwarePaginator {

        return $this->model
        ->query()
        ->upcoming()
        ->when($date, fn($query) => $query->whereDate('bookings.start', $date))
        ->orderBy($sort->getColumn(), $sort->getDirection())
        ->paginate($perPage);
    }
}
