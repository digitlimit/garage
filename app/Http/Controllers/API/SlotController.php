<?php

namespace App\Http\Controllers\API;

use App\Helpers\LogHelper;
use Illuminate\Support\Carbon;
use App\Helpers\ResponseHelper;
use App\Http\Requests\Slot\OpenRequest;
use App\Http\Requests\Slot\CloseRequest;
use App\Repositories\Contracts\SlotRepository;
use App\Repositories\Contracts\ClosedDateRepository;
use App\Repositories\Contracts\ClosedSlotRepository;

class SlotController extends BaseController
{
    public function __construct(
        readonly private LogHelper $log,
        readonly private SlotRepository $slot,
        readonly private ClosedDateRepository $closedDate,
        readonly private ClosedSlotRepository $closedSlot,
        readonly private ResponseHelper $response,
        readonly private Carbon $carbon
    ){}

    /**
     * Fetch a list of slots.
     */
    public function list()
    {
        $slots = $this
            ->slot
            ->all(['id', 'name']);

        return $this->response->ok($slots);
    }

    /**
     * Fetch all the booked (unavailable) slots as from today
     */
    public function bookedSlots()
    {
        $slots = $this
            ->slot
            ->bookedFromToday();

        return $this->response->ok($slots);
    }

    /**
     * Fetch a list of closed slots as from current date.
     */
    public function closedSlots()
    {info(request()->user());
        $slots = $this
            ->closedSlot
            ->closedFromToday();

        return $this->response->ok($slots);
    }

    /**
     * Fetch a list of closed dates.
     */
    public function closedDates()
    {
        $dates = $this
            ->closedDate
            ->closedFromToday();

        return $this->response->ok($dates);
    }

    /**
     * Close a slot to prevent client's from picking them
     */
    public function closeSlot(CloseRequest $request)
    {
        $slotId     = $request->validated('slot');
        $dateString = $request->validated('date');
        $date       = $this->carbon->createFromFormat('Y-m-d', $dateString);

        try {
            //@todo create an interface
            if($slotId && $date) {
                $this->closedSlot->close($slotId, $date);
            } else {
                $this->closedDate->close($date);
            }    

            return $this->response->noContent();

        } catch (\Exception $e) {
            $this->log->info($e->getMessage());
            return $this->response->server();
        }
    }

    /**
     * Open a closed slot to allow client's to pick them
     */
    public function openSlot(OpenRequest $request)
    {
        $slotId     = $request->validated('slot');
        $dateString = $request->validated('date');
        $date       = $this->carbon->createFromFormat('Y-m-d', $dateString);

        try {
            //@todo create an interface
            if($slotId && $date) {
                $this->closedSlot->open($slotId, $date);
            } else {
                $this->closedDate->open($date);
            }   
            
            return $this->response->noContent();
            
        } catch (\Exception $e) {
            $this->log->info($e->getMessage());
            return $this->response->server();
        }
    }
}
