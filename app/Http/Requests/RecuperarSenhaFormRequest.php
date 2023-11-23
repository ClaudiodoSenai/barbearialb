<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RecuperarSenhaFormRequest extends FormRequest
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
            'email' => 'required|max:120|email:rfc|exists:clientes,email'
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
        'email.required' => 'Email obrigatorio',
        'email.max' => 'o campo e-mail deve conter no máximo 120 caracteres',
        'email.email' => 'formato de email invalido',
        'email.unique' => 'E-mail já cadastrado',
        ];
    }
    
}
