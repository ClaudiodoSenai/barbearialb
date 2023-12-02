<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ClienteUpdateFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nome' => 'max:120|min:5 ',
            'celular' => 'max:11|min:10',
            'email' => 'max:120|email:rfc,|unique:clientes,email,'. $this->id,
            'cpf' => '|max:11|min:11|unique:clientes,cpf,'. $this->id,
            'dataNascimento' => '',
            'cidade' => 'max:120',
            'estado' => 'min:2|max:2',
            'pais' => 'max:80',
            'rua' => 'max:120',
            'numero' => 'max:10',
            'bairro' => 'max:100',
            'cep' => 'min:8|max:9',
            'complemento' => 'max:150',
            'senha' => ''
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'error' => $validator->errors()
        ]));
    }

    public function messages()
    {
        return [
            'nome.max' => 'O campo nome deve conter no máximo 120 caracteres',
            'nome.min' => 'O campo nome deve conter no minimo 5 caracteres',

            'celular.max' => 'Celular deve conter no maximo 11 caracteres',
            'celular.min' => 'Celular deve conter no minimo 10 caracteres',

            'email.max' => 'O campo e-mail deve conter no máximo 120 caracteres',
            'email.email' => 'Formato de email invalido',
            'email.unique' => 'E-mail já cadastrado',

            'cpf.max' => 'CPF deve conter no máximo 11 caracteres',
            'cpf.min' => 'CPF deve conter no mínimo 11 caracteres',
            'cpf.unique' => 'CPF Já cadastrado no sistema',

            'cidade.max' => 'O campo cidades deve conter no máximo 120 caracteres',

            'estado.min' => 'O campo estado deve conter no minimo 2 caracteres',
            'estado.max' => 'O campo estado deve conter no máximo 2 caracteres',

            'pais.max' => 'O campo pais deve conter no máximo 80 caracteres',

            'rua.max' => 'O campo rua deve conter no máximo 120 caracteres',
        
            'numero.max' => 'O campo numero deve conter no máximo 10 caracteres',
          
            'bairro.max' => 'O campo bairro deve conter no máximo 100 caracteres',


            'cep.max' => 'O campo cep deve conter no máximo 8 caracteres',
            'cep.min' => 'O campo cep deve conter no minimo 8 caracteres',

            'complemento.max' => 'O campo complemento deve conter no máximo 150 caracteres',

            'senha.required' => 'Senha obrigatoria'
        ];
    }
}
