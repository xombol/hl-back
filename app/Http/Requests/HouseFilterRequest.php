<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HouseFilterRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'filters' => ['sometimes', 'array'],
            'filters.*' => [Rule::in(
                ['name', 'min_price', 'max_price', 'bedrooms', 'bathrooms', 'storeys', 'garages']
            )],

            'filters.name' => 'sometimes|required|string',
            'filters.bedrooms' => 'sometimes|required|integer',
            'filters.bathrooms' => 'sometimes|required|integer',
            'filters.storeys' => 'sometimes|required|integer',
            'filters.garages' => 'sometimes|required|integer',

            'filters.min_price' => 'sometimes|numeric',
            'filters.max_price' => 'sometimes|numeric',
        ];
    }
}
