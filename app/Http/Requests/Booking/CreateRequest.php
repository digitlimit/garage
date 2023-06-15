<?php

namespace App\Http\Requests\Booking;

use App\Rules\Phone;
use App\Helpers\SettingHelper;
use Illuminate\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use App\Repositories\Contracts\SlotRepository;

class CreateRequest extends FormRequest
{
    public function __construct(
        readonly private SettingHelper  $setting,
        readonly private SlotRepository $slotRepository
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
            'name'  => ['required', 'string', 'min:3', 'max:180'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'min:5', 'max:13', new Phone],
            'make'  => ['required', 'min:3', 'max:80'],
            'model' => ['required', 'min:3', 'max:80'],
            'date'  => ['required', 'date_format:Y-m-d', 'after:yesterday'],
            'slot'  => ['required', 'integer']
        ];
    }

    /**
     * Get the "after" validation callables for the request.
     */
    public function after(): array
    {
        $open   = $this->setting->get('open');
        $close  = $this->setting->get('close');
        $date   = $this->date('date');
        $slotId = $this->slot;

        return [
            // new BusinessDay($date, $open, $close),
            function (Validator $validator) use($slotId, $date)
            {   
                if($this->validated('slot') 
                    && $this->validated('date')
                ){ 
                    $isAvailable = $this
                    ->slotRepository
                    ->isAvailable($slotId, $date);
            
                    if (!$isAvailable) {
                        $validator->errors()->add(
                            'slot',
                            "Slot is not available"
                        );
                    }
                }
            }
        ];
    }
}
