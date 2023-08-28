<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        $erros =[
            'name'=>'required',
        ];
        if ($this->method() == 'PUT'){

            if($this->get('password')) {
                $erros +=[
                    'password' => 'required|confirmed|min:6',
                ];

            }

        }else{
            $erros +=[
                'cpf' => [
                    'required',
                    Rule::unique('users')->ignore($this->id),
                    'cpf'
                ],
                'email' => [
                    'required',
                    Rule::unique('users')->ignore($this->id),
                    'email'
                ],
                'password' => 'required|confirmed|min:6',
            ];
        }
        return $erros;
    }
}
