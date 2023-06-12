<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Validator;
use Carbon\CarbonInterface;

class SlotAvailable
{
    public function __invoke(Validator $validator, CarbonInterface $carbon): void
    {
        $startTime = $validator->validated('start_time');
        $endTime   = $validator->validated('end_time');
    }
}

