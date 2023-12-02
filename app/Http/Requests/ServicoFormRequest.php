<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ServicoFormRequest extends FormRequest
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
            'nome' => 'required|max:80|min:5 |unique:servicos,nome',
            'descricao' => 'required|max:200|min:10',
            'duracao' => 'required|numeric',
            'preco' => 'required|decimal:2',
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
            'nome.max' => 'O campo nome deve conter no máximo 80 caracteres',
            'nome.min' => 'O campo nome deve conter no minimo 5 caracteres',
            'nome.unique'=>'Nome já cadastrado no sistema',
            'descricao.required' => 'Descricao obrigatório',
            'descricao.max' => 'Descricao deve conter no máximo 200 caracteres',
            'descricao.min' => 'Descricao deve conter no mínimo 10 caracteres',
            'duracao.required' => 'A duração é obrigatório',
            'duracao.numeric' => 'O campo deve conter apenas numeros',
            'preco.required' => 'O campo é obrigatório',
            'preco.decimal' => 'Informar valores em reais',
        
        ];

}
}