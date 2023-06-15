<?php

namespace App\Repositories\Eloquent;

use App\Models\ClosedSlot;
use Carbon\CarbonInterface;
use Illuminate\Support\Carbon;
use App\Repositories\Contracts\ClosedSlotRepository as RepositoryInterface;

class ClosedSlotRepository implements RepositoryInterface
{
    public function __construct(
        /**
         * An instance of closed slot model
         */
        readonly private ClosedSlot $model,

        /**
         * An instace of Carbon
         */
        readonly private Carbon $carbon
    ){}

    /**
     * Fetch all closed slots from today
     */
    public function closedFromToday() : mixed 
    {
        return $this
        ->model
        ->select(
            'slots.id',
            'slots.name',
            'closed_slots.date'
        )
        ->asFromDate($this->carbon->now())
        ->get();
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
