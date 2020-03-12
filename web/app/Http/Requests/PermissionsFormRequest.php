<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermissionsFormRequest extends FormRequest
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
           'name'     => 'required|string|max:50',
           'label'     => 'required|string|max:200',
        ];
    }
    
    public function messages()
    {
        return [
           'name.required' => 'O campo nome é obrigatório',
           'label.required' => 'O campo descrição é obrigatório'
        ];
    }
    
    
}
