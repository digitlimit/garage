<?php

namespace App\Repositories\Eloquent;

use App\Models\ClosedDate;
use App\Repositories\Contracts\ClosedDateRepository as RepositoryInterface;
use Carbon\CarbonInterface;
use Illuminate\Support\Carbon;

class ClosedDateRepository implements RepositoryInterface
{
    public function __construct(
        /**
         * An instance of closed date model
         */
        readonly private ClosedDate $model,

        /**
         * An instace of Carbon
         */
        readonly private Carbon $carbon
    ) {
    }

    /**
     * Fetch all closed dates from today
     */
    public function closedFromToday(): mixed
    {
        return $this
            ->model
            ->select('closed_dates.id')
            ->selectRaw('DATE(closed_dates.date) AS date')
            ->asFromDate($this->carbon->now())
            ->get();
    }

    /**
     * Close/Block a date
     */
    public function close(CarbonInterface $date): int
    {
        $closed = $this->model->whereDate('date', $date)->first();

        if (! empty($closed)) {
            return $closed->id;
        }

        $closed = $this
            ->model
            ->create(['date' => $date]);

        return $closed->id;
    }

    /**
     * Open a Closed/Blocked date
     */
    public function open(CarbonInterface $date): bool
    {
        $closed = $this->model->whereDate('date', $date)->first();

        if ($closed) {
            $closed->delete();

            return true;
        }

        return false;
    }
}
