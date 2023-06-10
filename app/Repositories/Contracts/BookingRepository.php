<?php

namespace App\Repositories\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Carbon\CarbonInterface;

interface BookingRepository
{
    /**
     * Create new booking
     */
    public function create(int $clientId, int $vehicleId, CarbonInterface $date) : int;

    /**
     * Fetch a paginated list of bookings.
     * 
     * @param array $filters An optional array of filters
     * @param int   $perPage The number of records per page, default 15
     */
    public function list(array $filters=[], ?int $perPage=null): LengthAwarePaginator;
}