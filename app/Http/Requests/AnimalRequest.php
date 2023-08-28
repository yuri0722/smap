<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnimalRequest extends FormRequest
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
        $erros = [
            'nome'=>'required',
            'especie_id'=>'required|not_in:0',
            'porte_id'=>'required|not_in:0',
            'kilos'=>'required',
            'anos'=>'required',
        ];
        return $erros;
    }


    public function messages()
    {
        return [
            'nome.required'=>'Qual o nome do animal?',
            'especie_id.not_in'=>'Escolha a espécie',
            'porte_id.not_in'=>'Escolha o porte',
            'kilos.required'=>'Qual o peso?',
            'anos.required'=>'Qual a idade do animal?',
        ];
    }
}
