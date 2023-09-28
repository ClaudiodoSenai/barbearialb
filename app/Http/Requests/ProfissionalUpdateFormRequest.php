<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProfissionalUpdateFormRequest extends FormRequest
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
            'nome' => 'max:120|min:5 ',
            'celular' => 'max:11|min:10',
            'email' => 'max:120|email:rfc,|unique:profissional,email,'. $this->id,
            'cpf' => '|max:11|min:11|unique:profissional,cpf,'. $this->id,
            'dataNascimento' => '',
            'cidade' => 'max:120',
            'estado' => 'min:2|max:2',
            'pais' => 'max:80',
            'rua' => 'max:120',
            'numero' => 'max:10',
            'bairro' => 'max:100',
            'cep' => 'min:8|max:8',
            'complemento' => 'max:150',
            'senha' => '',
            'salario'=>''
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'error' => $validator->errors()
        ]));
    }
}
