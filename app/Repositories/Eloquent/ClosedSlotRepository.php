<?php

namespace App\Repositories\Eloquent;

use App\Models\ClosedSlot;
use App\Repositories\Contracts\ClosedSlotRepository as RepositoryInterface;
use Carbon\CarbonInterface;
use Illuminate\Support\Carbon;

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
    ) {
    }

    /**
     * Fetch all closed slots from today
     */
    public function closedFromToday(): mixed
    {
        return $this
            ->model
            ->select(
                'closed_slots.id',
                'slots.id AS slot_id',
                'slots.name'
            )
            ->selectRaw('DATE(closed_slots.date) AS date')
            ->asFromDate($this->carbon->now())
            ->get();
    }

    /**
     * Close a slot for the given date
     */
    public function close(int $slotId, CarbonInterface $date): int
    {
        $closed = $this->model->closedFor($slotId, $date)->first();

        if (! empty($closed)) {
            return $closed->id;
        }

        $closed = $this
            ->model
            ->create(['slot_id' => $slotId, 'date' => $date]);

        return $closed->id;
    }

    /**
     * Open a closed slot for the give date
     */
    public function open(int $slotId, CarbonInterface $date): bool
    {
        $closed = $this->model->closedFor($slotId, $date)->first();

        if ($closed) {
            $closed->delete();

            return true;
        }

        return false;
    }
}
