<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AgendaFormRequest extends FormRequest
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
            'profisional_id' > 'integer|required',
            'cliente_id' => 'integer',
            'servico_id' => 'integer',
            'data_hora' => 'required|date',
            'tipo_pagamento' => 'required|max:20|min:3',
            'valor' => 'decimal:2',
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
            'profissional_id.integer' => "Insira somente numeros inteiros",
            'profissional_id.integer' => 'Id do Profissional obrigatório ',

            'cliente_id.integer' => "Insira somente numeros inteiros",

            'servico_id.integer' => "Insira somente numeros inteiros",

            'data_hora.required' => 'Data obrigatória',
            'data_hora.date' => 'Insira no formato de data',

            'tipo_pagamento.required' => 'Tipo de pagamento obrigatória',
            'tipo_pagamento.max' => 'O campo tipo pagamento deve conter no maximo de 20 caracteres',
            'tipo_pagamento.min' => 'O campo deve tipo pagamento deve conter no minimo 3 caracteres',

            'valor.decimal' => 'O campo deve conter 2 casas decimais'
        ];
    }
}
