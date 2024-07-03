<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDishRequest extends FormRequest
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
            'price' => 'required|numeric|min:5|max:300',
            'visible' => 'required|boolean',
            'thumb' => 'nullable',
            'restaurant_id' => 'required|exists:restaurants,id'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Il campo nome è obbligatorio.',
            'name.max' => 'Il campo nome non può superare i 100 caratteri.',
            'description_ingredients.required' => 'Il campo descrizione ingredienti è obbligatorio.',
            'price.required' => 'Il campo prezzo è obbligatorio.',
            'price.numeric' => 'Il campo prezzo deve essere un valore numerico.',
            'price.min' => 'Il campo prezzo deve essere almeno 5.',
            'price.max' => 'Il campo prezzo non può essere superiore a 300.',
            'visible.required' => 'Il campo visibile è obbligatorio.',
            'visible.boolean' => 'Il campo visibile deve essere vero o falso.',
            'thumb.nullable' => 'Il campo immagine di anteprima è facoltativo.',
            'restaurant_id.required' => 'Il campo ID del ristorante è obbligatorio.',
            'restaurant_id.exists' => 'Il ristorante selezionato non esiste.',
        ];
    }
}
