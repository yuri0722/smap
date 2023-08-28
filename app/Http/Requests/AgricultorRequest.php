<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgricultorRequest extends FormRequest
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
            'pessoa_id'=>'required|not_in:0',
            'nr_agro_familia'=>'required',
        ];
        return $erros;
    }

    public function messages()
    {
        return [
            'pessoa_id.required'=>'Escolha a pessoa',
            'pessoa_id.not_in'=>'Escolha a pessoa',
            'nr_agro_familia.required'=>'Digite o número de familiares na agricultura',
        ];
    }

}
