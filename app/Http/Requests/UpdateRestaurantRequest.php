<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRestaurantRequest extends FormRequest
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
            'slug'=>'string|unique:restaurants,slug',
            'address'=>'required|max:255',
            'vat'=>'required|string|min:11|max:11',
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
            'slug.string' => 'Il campo slug deve essere una stringa.',
            'slug.unique' => 'Il campo slug deve essere univoco.',
            'address.required' => 'Il campo indirizzo è obbligatorio.',
            'address.max' => 'Il campo indirizzo non può superare i 255 caratteri.',
            'vat.required' => 'Il campo partita IVA è obbligatorio.',
            'vat.string' => 'Il campo partita IVA deve essere una stringa.',
            'vat.min' => 'Il campo partita IVA deve contenere esattamente 11 caratteri.',
            'vat.max' => 'Il campo partita IVA deve contenere esattamente 11 caratteri.',
            'thumb.nullable' => 'Il campo thumb è opzionale.',
            'user_id.required' => 'Il campo user_id è obbligatorio.',
            'user_id.exists' => 'Il campo user_id deve esistere nella tabella users.',
            'type_id.required' => 'Il campo type_id è obbligatorio.',
            'type_id.exists' => 'Il campo type_id deve esistere nella tabella types.',
        ];
    }
}
