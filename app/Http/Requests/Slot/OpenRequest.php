<?php

namespace App\Http\Requests\Slot;

use Illuminate\Foundation\Http\FormRequest;

class OpenRequest extends FormRequest
{
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
            'slot_id' => ['required', 'integer', 'exists:slots,id'],
            'date'    => ['required', 'date:"Y-m-d"', 'after:yesterday'],
        ];
    }
}