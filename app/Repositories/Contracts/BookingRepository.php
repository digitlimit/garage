<?php

namespace App\Repositories\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Carbon\CarbonInterface;
use App\Values\BookingDate;
use App\Values\BookingSorting;

interface BookingRepository
{
    /**
     * Create new booking
     * 
     * @param int         $clientId  Client ID
     * @param int         $vehicleId Vehicle ID
     * @param BookingDate $date The booking date value object 
     */
    public function create(int $clientId, int $vehicleId, BookingDate $date) : int;

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