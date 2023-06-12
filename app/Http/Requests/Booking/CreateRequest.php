<?php

namespace App\Http\Requests\Booking;

use App\Rules\BusinessDay;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Config\Repository;

use App\Rules\Phone;
use App\Rules\SameDay;
use App\Rules\SlotAvailable;
use App\Rules\WithinInterval;
use App\Rules\WithinOpeningTime;

class CreateRequest extends FormRequest
{
    public function __construct(
        readonly private Repository $config,
        readonly private Carbon $carbon
    ){}

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'        => ['required', 'string', 'min:3', 'max:180'],
            'email'       => ['required', 'email', 'max:255'],
            'phone'       => ['required', 'min:5', 'max:13', new Phone],
            'make'        => ['required', 'min:3', 'max:80'],
            'model'       => ['required', 'min:3', 'max:80'],
            'start_time'  => ['required', 'date:"Y-m-d H:i:s"', 'after:yesterday'],
            'end_time'    => ['required', 'date:"Y-m-d H:i:s"']
        ];
    }

    /**
     * Get the "after" validation callables for the request.
     */
    public function after(): array
    {
        list($interval, $open, $close) = $this->config->get('setting');

        $startTime = $this->carbon->createFromFormat(
            'Y-m-m H:i:s', 
            $this->start_time
        );
   
        $endTime = $this->carbon->createFromFormat(
            'Y-m-m H:i:s',  
            $this->end_time
        );

        return [
            new SameDay($startTime, $endTime),
            new WithinInterval($interval, $startTime, $endTime),
            new BusinessDay($startTime, $endTime, $open, $close),
            new SlotAvailable($startTime, $endTime),
        ];
    }
}
