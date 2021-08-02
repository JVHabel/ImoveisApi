<?php

namespace App\Http\Requests\Imoveis;

use Illuminate\Foundation\Http\FormRequest;

class PostInteressadosRequest extends FormRequest
{

    public function rules()
    {
        return [
            'nome' => 'required',
            'email' => 'required|unique:interessados,email',
            'imovel_id' => 'nullable'
        ];
    }

    public function messages()
    {
        return [

            'nome.required' => 'O campo nome é obrigatorio',

            'email.required' => 'O campo email é obrigatorio',
            'email.unique' => 'O campo email deve ser unico'

        ];
    }
}
