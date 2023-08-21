<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        $id = $this->route('user');

        return [
            'name' => ['required', 'string', 'max:255'],
            'registration' => ['required', 'string', 'max:255', Rule::unique('users', 'registration')->ignore($id)],
            'username' => ['required', 'string', 'max:255', Rule::unique('users', 'username')->ignore($id)],
            'is_admin' => ['sometimes', 'required', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'unique' => 'O campo :attribute já está sendo utilizando.',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'name',
            'username' => 'usuário',
            'is_admin' => 'tipo usuário',
        ];
    }
}
