<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportarDataFixaRequest extends FormRequest
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
            'file' => 'required|file|mimes:xls,xlsx',
            'data' => 'required|date',
        ];
    }

    public function messages(): array
    {
        return [
            'file.required' => 'O arquivo é obrigatório.',
            'file.file' => 'O arquivo deve ser um arquivo válido.',
            'file.mimes' => 'O arquivo deve ter uma extensão válida (xls, xlsx).',
            'data.required' => 'O campo data é obrigatório.',
            'data.date' => 'A data informada não é válida.',
        ];
    }
}
