<?php

namespace App\Repositories\Eloquent;

use App\Models\ClosedDate;
use Carbon\CarbonInterface;
use Illuminate\Support\Carbon;
use App\Repositories\Contracts\ClosedDateRepository as RepositoryInterface;

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
    ){}

    /**
     * Fetch all closed dates from today
     */
    public function closedFromToday() : mixed 
    {
        return $this
        ->model
        ->select('closed_dates.date AS closed_date')
        ->asFromDate($this->carbon->now())
        ->get();
    }

    /**
     * Close/Block a date
     */
    public function close(CarbonInterface $date) : int
    {
        $closed = $this
        ->model
        ->firstOrCreate(['date' => $date]);

        return $closed->id;
    }

    /**
     * Open a Closed/Blocked date
     */
    public function open(CarbonInterface $date) : bool
    {
        $closed = $this
        ->model
        ->whereDate(['date' => $date])
        ->first();

        if($closed) {
            $closed->delete();
            return true;
        }

        return false;
    }
}
