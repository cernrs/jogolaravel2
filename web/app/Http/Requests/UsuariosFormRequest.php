<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuariosFormRequest extends FormRequest
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
           'name'     => 'required|string|max:255',
           'cel'      => 'required',
           'email'    => 'required|unique:users,email',
           'password' => 'required',
           'image'    => 'image',
           'role_id'    => 'required',
        ];
    }
    
    public function messages()
    {
        return [
           'cel.required' => 'O campo celular é obrigatório',
           'role_id.required' => 'Pelo menos um perfil deve ser selecionado'
        ];
    }
    
    
}
