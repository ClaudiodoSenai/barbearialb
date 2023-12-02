<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProfissionalFormRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome' => 'required|max:120|min:5 ',
            'celular' => 'required|max:11|min:10',
            'email' => 'required|max:120|email:rfc|unique:profissionals,email,',
            'cpf' => 'max:11|min:11|required|unique:profissionals,cpf,',
            'dataNascimento' => 'required',
            'cidade' => 'required|max:120',
            'estado' => 'required|min:2|max:2',
            'pais' => 'required|max:80',
            'rua' => 'required|max:120',
            'numero' => 'required|max:10',
            'bairro' => 'required|max:100',
            'cep' => 'required|min:8|max:9',
            'complemento' => 'max:150',
            'senha' => 'required',
            'salario' => 'required|decimal:2'
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
            'nome.max' => 'O campo nome deve conter no máximo 120 caracteres',
            'nome.min' => 'O campo nome deve conter no minimo 5 caracteres',

            'celular.required' => 'Celular obrigatorio',
            'celular.max' => 'Celular deve conter no maximo 11 caracteres',
            'celular.min' => 'Celular deve conter no minimo 10 caracteres',

            'email.required' => 'Email obrigatorio',
            'email.max' => 'O campo e-mail deve conter no máximo 120 caracteres',
            'email.email' => 'Formato de email invalido',
            'email.unique' => 'E-mail já cadastrado',

            'cpf.required' => 'CPF obrigatório',
            'cpf.max' => 'CPF deve conter no máximo 11 caracteres',
            'cpf.min' => 'CPF deve conter no mínimo 11 caracteres',
            'cpf.unique' => 'CPF Já cadastrado no sistema',

            'dataNascimento.required' => 'Data de nascimento obrigatória',

            'cidade.required' => 'Cidade obrigatória',
            'cidade.max' => 'O campo cidades deve conter no máximo 120 caracteres',

            'estado.required' => 'Estado obrigatório',
            'estado.min' => 'O campo estado deve conter no minimo 2 caracteres',
            'estado.max' => 'O campo estado deve conter no máximo 2 caracteres',

            'pais.required' => 'pais obrigatório',
            'pais.max' => 'O campo pais deve conter no máximo 80 caracteres',

            'rua.required' => 'rua obrigatório',
            'rua.max' => 'O campo rua deve conter no máximo 20 caracteres',

            'numero.required' => 'numero obrigatório',
            'numero.max' => 'O campo numero deve conter no máximo 10 caracteres',

            'bairro.required' => 'bairro obrigatório',
            'bairro.max' => 'O campo bairro deve conter no máximo 100 caracteres',

            'cep.required' => "O campo cep é obrigatorio",
            'cep.max' => 'O campo cep deve conter no máximo 8 caracteres',
            'cep.min' => 'O campo cep deve conter no minimo 8 caracteres',

            'complemento.max' => 'O campo complemento deve conter no máximo 150 caracteres',

            'senha.required' => 'Senha obrigatoria',

            'salario.decimal' => 'Informar valores em reais'
        ];
    }
    }

