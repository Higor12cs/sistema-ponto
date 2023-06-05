<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeeRequest extends FormRequest
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
        $id = $this->route('employee');

        return [
            'registration' => ['nullable', 'alpha_num', Rule::unique('employees', 'registration')->ignore($id)],
            'name' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'alpha_num' => 'O campo :attribute permite apenas letras e números.',
            'unique' => 'O campo :attribute já esta sendo utilizado.'
        ];
    }
}
