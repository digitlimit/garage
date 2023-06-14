<?php

namespace App\Http\Controllers\API;

use App\Helpers\LogHelper;
use Carbon\CarbonInterface;
use App\Helpers\ResponseHelper;
use App\Http\Requests\Slot\OpenRequest;
use App\Http\Requests\Slot\CloseRequest;
use App\Repositories\Contracts\SlotRepository;

class SlotController extends BaseController
{
    public function __construct(
        readonly private LogHelper $log,
        readonly private SlotRepository $slot,
        readonly private ResponseHelper $response,
        readonly private CarbonInterface $carbon
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
     * Close a slot to prevent client's from picking them
     */
    public function close(CloseRequest $request)
    {
        $slotId     = $request->validated('slot_id');
        $dateString = $request->validate('date');

        $date = $this
        ->carbon
        ->createFromFormat('Y-m-d', $dateString);

        try {
            $this->slot->close($slotId, $date);
            return $this->response->noContent();
        } catch (\Exception $e) {
            $this->log->info($e->getMessage());
            return $this->response->server();
        }
    }

    /**
     * Open a closed slot to allow client's to pick them
     */
    public function open(OpenRequest $request)
    {
        $slotId     = $request->validated('slot_id');
        $dateString = $request->validate('date');

        $date = $this
        ->carbon
        ->createFromFormat('Y-m-d', $dateString);

        try {
            $this->slot->open($slotId, $date);
            return $this->response->noContent();
        } catch (\Exception $e) {
            $this->log->info($e->getMessage());
            return $this->response->server();
        }
    }
}
