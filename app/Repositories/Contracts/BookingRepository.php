<?php

namespace App\Repositories\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Carbon\CarbonInterface;
use App\Values\BookingSorting;
use DateTime;

interface BookingRepository
{
    public function find(int $bookingId) : mixed;

    public function create(
        int $slotId, 
        int $clientId, 
        int $vehicleId, 
        DateTime $date
    ) : int;

    public function list(BookingSorting $sort,int $perPage=15): LengthAwarePaginator;

    public function filterByDate(
        CarbonInterface $date,
        BookingSorting  $sort,
        int             $perPage=15
    ): LengthAwarePaginator;
}