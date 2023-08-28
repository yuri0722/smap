<?php namespace App\Http\Requests;

use App\Models\SmapTraitModel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PessoaRequest extends FormRequest
{
    use SmapTraitModel;
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
      //  $this->cpf = $this->soNumero($this->get('cpf'));

        //dd($this->all());
        $erros = [
            'nome'=>'required',
            'email' => [
               // 'required',
                Rule::unique('pessoas')->ignore($this->id),
                'email',
                'nullable'
            ],
            'endereco'=>'required',
            'data_nascimento'=>'required',
        ];
        if($this->get('pessoa_tipo')=="F"){
            $erros += [
                'cpf' => [
                    'required',
                    Rule::unique('pessoas')->ignore($this->id),
                    'cpf'
                ],
                'celular'=>'required',
            ];
        }else{
            $erros += [
                'cnpj' => [
                    'required',
                    Rule::unique('pessoas')->ignore($this->id),
                    'cnpj'
                ],
                'telefone'=>'required',
            ];
        }
        return $erros;
    }

   /*public function messages()
    {
        return [
            $nome_cpf=>'O CPF já existe está sendo usado',

        ];
    }*/
    protected function getValidatorInstance()
    {
        $data = $this->all();
        $data['cpf'] = $this->soNumero($this->get('cpf'));
        $data['cnpj'] = $this->soNumero($this->get('cnpj'));
        $this->getInputSource()->replace($data);

        /*modify data before send to validator*/

        return parent::getValidatorInstance();
    }
}
