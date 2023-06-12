<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Validator;
use Carbon\CarbonInterface;

class WithinInterval
{
    public function __construct(
        readonly private CarbonInterface $startTime,
        readonly private CarbonInterface $endTime,
        readonly private int             $interval
    ){}

    public function __invoke(Validator $validator): void
    {
        $minutes = $this->startTime->diffInMinutes($this->endTime);

        if($this->startTime->equalTo($this->endTime) 
            || $minutes % $this->interval
        ) {
            $validator->errors()->add(
                'start_time',
                "Slots should be intervals of $this->interval"
            );
        }
    }
}