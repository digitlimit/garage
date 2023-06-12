<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Carbon;
use Carbon\CarbonInterface;

class BusinessDay
{
    public function __construct(
        readonly private CarbonInterface $startTime,
        readonly private CarbonInterface $endTime,
        readonly private string          $openingTime,
        readonly private string          $oclosingTime,

    ){}

    public function __invoke(Validator $validator): void
    {
        // if()

        // $minutes = $startTime->diffInMinutes($endTime);

        // if($startTime == $startTime || $minutes % $this->interval) {
        //     $validator->errors()->add(
        //         'start_time',
        //         "SLots should be intervals of $this->interval"
        //     );
        // }
    }
}

