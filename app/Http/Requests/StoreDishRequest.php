<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDishRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:100',
            'description_ingredients' => 'required',
            'price' => 'required|numeric|between:0.01,999.99',
            'visible' => 'boolean',
            'thumb' => 'nullable',
            'restaurant_id' => 'required|exists:restaurants,id'
        ];
    }
}
