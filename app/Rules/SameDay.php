<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Validator;
use Carbon\CarbonInterface;

class SameDay
{
    public function __construct(
        readonly private CarbonInterface $startTime,
        readonly private CarbonInterface $endTime
    ){}

    public function __invoke(Validator $validator): void
    {
        if($this->startTime->isSameDay($this->endTime)) {
            $validator->errors()->add(
                'start_time',
                "Slots must be within the same day"
            );
        }
    }
}
