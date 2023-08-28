<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VeiculoRequest extends FormRequest
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
            'quilometragem'=>'required',
        ];
        return $erros;
    }

    public function messages()
    {
        return [
            'nome.required'=>'Escolha um nome',
        ];
    }
}
