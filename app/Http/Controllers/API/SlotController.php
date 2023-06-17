<?php

namespace App\Http\Controllers\API;

use App\Helpers\LogHelper;
use App\Helpers\ResponseHelper;
use App\Http\Requests\Slot\CloseDateRequest;
use App\Http\Requests\Slot\CloseSlotRequest;
use App\Http\Requests\Slot\OpenDateRequest;
use App\Http\Requests\Slot\OpenSlotRequest;
use App\Repositories\Contracts\ClosedDateRepository;
use App\Repositories\Contracts\ClosedSlotRepository;
use App\Repositories\Contracts\SlotRepository;
use Illuminate\Support\Carbon;

class SlotController extends BaseController
{
    public function __construct(
        readonly private LogHelper $log,
        readonly private SlotRepository $slot,
        readonly private ClosedDateRepository $closedDate,
        readonly private ClosedSlotRepository $closedSlot,
        readonly private ResponseHelper $response,
        readonly private Carbon $carbon
    ) {
    }

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
    {
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
     * Close a date to prevent clients from picking them
     */
    public function closeDate(CloseDateRequest $request)
    {
        $dateString = $request->validated('date');
        $date = $this->carbon->createFromFormat('Y-m-d', $dateString);

        try {
            $this->closedDate->close($date);

            return $this->response->noContent();
        } catch (\Exception $e) {
            $this->log->info($e->getMessage());

            return $this->response->server();
        }
    }

    /**
     * Close a slot to prevent clients from picking them
     */
    public function closeSlot(CloseSlotRequest $request)
    {
        $slotId = $request->validated('slot');
        $dateString = $request->validated('date');
        $date = $this->carbon->createFromFormat('Y-m-d', $dateString);

        try {
            $this->closedSlot->close($slotId, $date);

            return $this->response->noContent();
        } catch (\Exception $e) {
            $this->log->info($e->getMessage());

            return $this->response->server();
        }
    }

    /**
     * Open a closed slot date
     */
    public function openDate(OpenDateRequest $request)
    {
        $dateString = $request->validated('date');
        $date = $this->carbon->createFromFormat('Y-m-d', $dateString);

        try {
            $this->closedDate->open($date);

            return $this->response->noContent();
        } catch (\Exception $e) {
            $this->log->info($e->getMessage());

            return $this->response->server();
        }
    }

    /**
     * Open a closed slot
     */
    public function openSlot(OpenSlotRequest $request)
    {
        $slotId = $request->validated('slot');
        $dateString = $request->validated('date');
        $date = $this->carbon->createFromFormat('Y-m-d', $dateString);

        try {
            $this->closedSlot->open($slotId, $date);

            return $this->response->noContent();
        } catch (\Exception $e) {
            $this->log->info($e->getMessage());

            return $this->response->server();
        }
    }
}
