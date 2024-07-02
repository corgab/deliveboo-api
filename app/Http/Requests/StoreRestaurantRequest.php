<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRestaurantRequest extends FormRequest
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
            'name'=>'required|max:150|string',
            'address'=>'required|max:255',
            'vat'=>'required|string|min:11|max:11',
            'thumb'=>'nullable',
            'user_id'=> 'required|exists:users,id',
            'type_id'=>'required|exists:types,id'
        ];
    }
}
