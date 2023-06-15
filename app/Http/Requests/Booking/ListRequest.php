<?php

namespace App\Http\Requests\Booking;

use App\Values\BookingSorting;
use Illuminate\Validation\Rules\In;
use Illuminate\Foundation\Http\FormRequest;

class ListRequest extends FormRequest
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
        $minPage = BookingSorting::MIN_PER_PAGE;
        $maxPage = BookingSorting::MAX_PER_PAGE;
        
        return [
            'per_page'       => ['nullable', 'integer', "min:$minPage", "max:$maxPage"],
            'sort_column'    => ['nullable', new In(BookingSorting::COLUMNS)],
            'sort_direction' => ['nullable', new In(BookingSorting::DIRECTIONS)],
            'date'           => ['nullable', 'date_format:Y-m-d'],
        ];
    }
}
