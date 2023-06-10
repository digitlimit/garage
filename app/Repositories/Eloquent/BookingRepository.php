<?php

namespace App\Repositories\Eloquent;

use Carbon\CarbonInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Repositories\Contracts\BookingRepository as RepositoryInterface;
use App\Models\Booking;

class BookingRepository implements RepositoryInterface
{
    public function __construct(private Booking $booking)
    {}

    /**
     * A concrete eloquent method that creates new booking
     * 
     * @param int $clientId The client ID from the clients database table
     * @param int $clientId The client ID from the clients database table 
     */
    public function create(int $clientId, int $vehicleId, CarbonInterface $date) : int
    {
       
    }

    /**
     * Fetch a paginated collection of upcoming bookings.
     * 
     * @param array $filters An optional array of filters
     * @param int   $perPage The number of records per page, default 15
     */
    public function list(array $filters=[], ?int $perPage=null): LengthAwarePaginator
    {
        
    }
}