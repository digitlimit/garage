<?php

namespace App\Repositories\Eloquent;

use App\Models\Slot;
use App\Repositories\Contracts\SlotRepository as RepositoryInterface;
use Carbon\CarbonInterface;
use Illuminate\Support\Carbon;

class SlotRepository implements RepositoryInterface
{
    public function __construct(
        /**
         * An instance of the vehicle eloquent model
         */
        readonly private Slot $model,

        /**
         * An instace of Carbon
         */
        readonly private Carbon $carbon
    ) {
    }

    /**
     * Fetch a list of slots
     */
    public function all(array $columns): mixed
    {
        return $this
            ->model
            ->all($columns);
    }

    /**
     * Check if a given date is available
     */
    public function isAvailable(int $slotId, CarbonInterface $date): bool
    {
        $slot = $this
            ->model
            ->select('slots.id')
            ->availability($slotId, $date)
            ->first();

        return $slot ? false : true;
    }

    /**
     * Fetch all unavailable slots from today
     */
    public function bookedFromToday(): mixed
    {
        $bookedSlots = $this
            ->model
            ->select(
                'slots.id',
                'slots.name'
            )
            ->selectRaw('DATE(bookings.date) AS date')
            ->bookedAsFromDate($this->carbon->now())
            ->get();

        return $bookedSlots;
    }
}
