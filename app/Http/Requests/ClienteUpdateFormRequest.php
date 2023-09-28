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
            'cep' => 'min:8|max:8',
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
            'nome.required' => "O campo nome é obrigatorio",
            'nome.max' => 'o campo nome deve conter no máximo 120 caracteres',
            'nome.min' => 'o campo nome deve conter no minimo 5 caracteres',

            'celular.required' => 'Celular obrigatorio',
            'celular.max' => 'celular deve conter no maximo 11 caracteres',
            'celular.min' => 'celular deve conter no minimo 10 caracteres',

            'email.required' => 'Email obrigatorio',
            'email.max' => 'o campo e-mail deve conter no máximo 120 caracteres',
            'email.email' => 'formato de email invalido',
            'email.unique' => 'E-mail já cadastrado',


            'cpf.required' => 'CPF obrigatório',
            'cpf.max' => 'CPF deve conter no máximo 11 caracteres',
            'cpf.min' => 'CPF deve conter no mínimo 11 caracteres',
            'cpf.unique' => 'Cpf Já cadastrado no sistema',

            'dataNascimento.required' => 'Data de nascimento obrigatória',

            'cidade.required' => 'Cidade obrigatória',
            'cidade.max' => 'O campo cidades deve conter no máximo 120 caracteres',

            'estado.required' => 'Estado obrigatório',
            'estado.min' => 'O campo estado deve conter no minimo 2 caracteres',
            'estado.max' => 'O campo estado deve conter no máximo 2 caracteres',

            'pais.required' => 'pais obrigatório',
            'pais.max' => 'O campo pais deve conter no máximo 2 caracteres',

            'rua.required' => 'rua obrigatório',
            'rua.max' => 'O campo rua deve conter no máximo 2 caracteres',

            'numero.required' => 'numero obrigatório',
            'numero.max' => 'O campo numero deve conter no máximo 2 caracteres',

            'bairro.required' => 'bairro obrigatório',
            'bairro.max' => 'O campo bairro deve conter no máximo 2 caracteres',

            'cep.required' => "O campo cep é obrigatorio",
            'cep.max' => 'o campo cep deve conter no máximo 120 caracteres',
            'cep.min' => 'o campo cep deve conter no minimo 5 caracteres',

            'complemento.max' => 'O campo complemento deve conter no máximo 2 caracteres',

            'senha.required' => 'Senha obrigatoria'
        ];
    }
}
