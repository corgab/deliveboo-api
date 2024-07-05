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
            'price' => 'required|numeric|between:1,900',
            'visible' => 'required|boolean',
            'restaurant_id' => 'required|exists:restaurants,id',
            'thumb' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048'
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
            'price.between' => 'Il campo prezzo deve essere compreso tra 1 e 900',
            'visible.required' => 'Il campo visibile è obbligatorio.',
            'visible.boolean' => 'Il campo visibile deve essere vero o falso.',
            'thumb.nullable' => 'Il campo immagine di anteprima è facoltativo.',
            'thumb.image' => 'Il file deve essere un\'immagine.',
            'thumb.mimes' => 'L\'immagine deve essere in uno dei seguenti formati: jpeg, png, jpg, svg.',
            'thumb.max' => 'L\'immagine non può essere più grande di 2 MB.',
            'restaurant_id.required' => 'Il campo ID del ristorante è obbligatorio.',
            'restaurant_id.exists' => 'Il ristorante selezionato non esiste.',
        ];
    }
}
