<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PesquisaDataRequest extends FormRequest
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
            'dataInicial'=>'required',
           // 'dataFinal'=>'required',
        ];
    }


    public function messages()
    {
        return [
            'dataInicial.required'=>'Escolha uma data incial',
         //   'dataFinal.required'=>'Escolha uma data final',
        ];
    }
}
