<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EtapasInscricoesFormRequest extends FormRequest
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
           'jogador2' => 'required',
        ];
    }
    
    public function messages()
    {
        return [
           'jogador2.required' => 'Escolha com quem vai jogar.'
        ];
    }
    
    
}
