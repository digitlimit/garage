<?php

namespace App\Rules;

use Carbon\CarbonInterface;
use Illuminate\Contracts\Validation\Validator;

class BusinessDay
{
    public function __construct(
        readonly private CarbonInterface $date
    ) {
    }

    public function __invoke(Validator $validator): void
    {
        if ($this->date->isWeekend()) {
            $validator
                ->errors()->add('date', "We currently do not open on weekends");
        }
    }
}
