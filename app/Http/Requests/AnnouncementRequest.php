<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnnouncementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:100|min:5',
            'body' => 'required|string|max:800|min:10',
            'price' => 'required'
        ];
    }

    public function messages() {
        return [
            'title.required' => 'Devi inserire un titolo',
            'title.min' => 'Il titolo deve contenere minimo 5 caratteri',
            'title.max' => 'Il titolo deve contenere massimo 100 caratteri',
    
            'body.required' => 'Devi inserire una descrizione',
            'body.min' => 'Devi inserire un messaggio di almeno 10 caratteri',
            'body.max' => 'Devi inserire un messaggio di massimo 800 caratteri',

            'price.required' => 'Devi inserire un prezzo',
        ];
    }
}