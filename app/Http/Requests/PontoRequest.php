<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PontoRequest extends FormRequest
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
            'data' => ['required', 'date'],
            'user_id' => ['required', 'exists:users,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'exists' => 'O :attribute não está cadastrado ou não é um :attribute válido.'
        ];
    }

    public function attributes(): array
    {
        return [
            'user_id' => 'responsável',
        ];
    }
}
