<?php

namespace App\Repositories\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Carbon\CarbonInterface;
use App\Values\BookingSorting;
use DateTime;

interface BookingRepository
{
    /**
     * Create new booking
     * 
     * @param int      $clientId  Client ID
     * @param int      $vehicleId Vehicle ID
     * @param DateTime $date The booking date 
     */
    public function create(
        int $slotId, 
        int $clientId, 
        int $vehicleId, 
        DateTime $date
    ) : int;

    public function list(
        BookingSorting  $sort,
        int             $perPage=15
    ): LengthAwarePaginator;

    public function filterByDate(
        CarbonInterface $date,
        BookingSorting  $sort,
        int             $perPage=15
    ): LengthAwarePaginator;
}