<?php

namespace App\Http\Controllers\API;

use App\Helpers\LogHelper;
use Carbon\CarbonInterface;
use App\Helpers\ResponseHelper;
use App\Http\Requests\ClosedDate\OpenRequest;
use App\Http\Requests\ClosedDate\CloseRequest;
use App\Repositories\Contracts\ClosedDateRepository;

class ClosedDateController extends BaseController
{
    public function __construct(
        readonly private LogHelper $log,
        readonly private ClosedDateRepository $closed,
        readonly private ResponseHelper  $response,
        readonly private CarbonInterface $carbon
    ){}

    /**
     * Fetch a list of closed dates.
     */
    public function list()
    {
        $dates = $this
            ->closed
            ->closedFromToday();

        return $this->response->ok($dates);
    }

    /**
     * Close a whole date from being booked
     */
    public function close(CloseRequest $request)
    {
        $dateString = $request->validate('date');

        $date = $this
        ->carbon
        ->createFromFormat('Y-m-d', $dateString);

        try {
            $this->closed->close($date);
            return $this->response->noContent();
        } catch (\Exception $e) {
            $this->log->info($e->getMessage());
            return $this->response->server();
        }
    }

    /**
     * Repen a closed date from being booked
     */
    public function open(OpenRequest $request)
    {
        $dateString = $request->validate('date');

        $date = $this
        ->carbon
        ->createFromFormat('Y-m-d', $dateString);

        try {
            $this->closed->open($date);
            return $this->response->noContent();
        } catch (\Exception $e) {
            $this->log->info($e->getMessage());
            return $this->response->server();
        }
    }
}
