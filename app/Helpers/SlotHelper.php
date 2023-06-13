<?php

namespace App\Helpers;

use Carbon\CarbonInterval;
use Carbon\Carbon;
class SlotHelper
{
    public function __construct(  
        private int    $interval,
        private string $open,
        private string $close
    ){}

    /**
     * Generate an array of slots from the open and close time
     */
    public function slots() : array 
    {
        $slots = [];

        $intervals = CarbonInterval::minutes($this->interval)
        ->toPeriod($this->open, $this->close)
        ->toArray();

        $chunks = array_chunk($intervals, 2);

        foreach($chunks as $chunk)
        {
            if(count($chunk) != 2){
                continue;
            }

            $startTime = $chunk[0];
            $endTime   = $chunk[1];

            $slots[] = [
                'name'       => $startTime->format('H:i') . ' - ' . $endTime->format('H:i'),
                'start_time' => $startTime,
                'end_time'   => $endTime,
            ]; 
        }

        return $slots;
    }
}
