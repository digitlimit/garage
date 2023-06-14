<?php

namespace App\Repositories\Eloquent;

use App\Models\Slot;
use Carbon\CarbonInterface;
use App\Repositories\Contracts\SlotRepository as RepositoryInterface;

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
        readonly private CarbonInterface $carbon
    ){}

    /**
     * Fetch a list of slots
     */
    public function all(array $columns) : mixed
    {
        return $this
        ->model
        ->all($columns);
    }
    
    /**
     * Fetch all the closed slots from today
     */
    public function closedFromToday() : mixed
    {
        return $this
        ->model
        ->select(
            'bookings.slot_id     AS booking_slot_id', 
            'bookings.date        AS booking_slot_date',
            'closed_slots.slot_id AS closed_slot_id',
            'closed_slots.date    AS closed_slot_date'
        )
        ->asFromDate($this->carbon->now())
        ->get();
    }

    /**
     * Check if a given date is available
     */
    public function isAvailable(int $slotId, CarbonInterface $date) : bool
    {
        $total = $this
        ->model
        ->availability($slotId, $date)
        ->count();

        return !(bool) $total;
    }

    /**
     * Close a ssllot for the given date
     */
    public function close(int $slotId, CarbonInterface $date) : int
    {
        $closed = $this
        ->model
        ->firstOrCreate(['slot_id' => $slotId, 'date' => $date]);

        return $closed->id;
    }

    /**
     * Open a closed slot for the give date
     */
    public function open(int $slotId, CarbonInterface $date) : bool
    {
        $closed = $this
        ->model
        ->where('slot_id', $slotId)
        ->whereDate(['date' => $date])
        ->first();

        if($closed) {
            $closed->delete();
            return true;
        }

        return false;
    }
}
