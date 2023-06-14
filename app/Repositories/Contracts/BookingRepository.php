<?php

namespace App\Repositories\Contracts;

use Carbon\CarbonInterface;
use App\Values\BookingSorting;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface BookingRepository
{
    public function find(int $bookingId) : mixed;

    public function create(
        int $slotId, 
        int $clientId, 
        int $vehicleId, 
        CarbonInterface $date
    ) : int;

    public function list(BookingSorting $sort,int $perPage=15): LengthAwarePaginator;

    public function filterByDate(
        CarbonInterface $date,
        BookingSorting  $sort,
        int             $perPage=15
    ): LengthAwarePaginator;
}