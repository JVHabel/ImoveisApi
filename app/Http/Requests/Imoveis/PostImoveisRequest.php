<?php

namespace App\Http\Requests\Imoveis;

use Illuminate\Foundation\Http\FormRequest;

class PostImoveisRequest extends FormRequest
{

    public function rules()
    {
        return [
            'codigo' => 'required|unique:imoveis,codigo',
            'tipo' => 'required',
            'pretensao' => 'required',
            'titulo' => 'required',
            'detalhes' => 'required',
            'quartos' => 'required',
            'valor' => 'required'
        ];
    }

    public function messages()
    {
        return [

            'codigo.required' => 'O campo codigo é obrigatorio',
            'codigo.unique' => 'O campo codigo deve ser unico',

            'tipo.required' => 'O campo tipo é obrigatorio',

            'pretensao.required' => 'O campo pretensao é obrigatorio',

            'titulo.required' => 'O campo titulo é obrigatorio',

            'detalhes.required' => 'O campo detalhes é obrigatorio',

            'quartos.required' => 'O campo quartos é obrigatorio',

            'valor.required' => 'O campo valor é obrigatorio',

            ];
    }
}
