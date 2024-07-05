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
            'vat'=>'required|digits:11',
            'thumb'=>'nullable',
            'user_id'=> 'required|exists:users,id',
            'type_id'=>'required|exists:types,id'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Il campo nome è obbligatorio.',
            'name.max' => 'Il campo nome non può superare i 150 caratteri.',
            'name.string' => 'Il campo nome deve essere una stringa.',
            'address.required' => 'Il campo indirizzo è obbligatorio.',
            'address.max' => 'Il campo indirizzo non può superare i 255 caratteri.',
            'vat.required' => 'Il campo partita IVA è obbligatorio.',
            'vat.digits' => 'Il campo partita IVA deve contenere 11 numeri.',
            'user_id.required' => 'Il campo user_id è obbligatorio.',
            'user_id.exists' => 'Il campo user_id deve esistere nella tabella users.',
            'type_id.required' => 'Il campo type_id è obbligatorio.',
            'type_id.exists' => 'Il campo type_id deve esistere nella tabella types.',
        ];
    }
}
