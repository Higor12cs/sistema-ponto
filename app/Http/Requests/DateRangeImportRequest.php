<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DateRangeImportRequest extends FormRequest
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
            'date1' => 'required|date',
            'date2' => 'required|date|after_or_equal:date1',
        ];
    }

    public function messages(): array
    {
        return [
            'file.required' => 'O arquivo é obrigatório.',
            'file.file' => 'O arquivo deve ser um arquivo válido.',
            'file.mimes' => 'O arquivo deve ter uma extensão válida (xls, xlsx).',
            'date1.required' => 'O campo data inicial é obrigatório.',
            'date1.date' => 'A data inicial informada não é válida.',
            'date2.required' => 'O campo data final é obrigatório.',
            'date2.date' => 'A data final informada não é válida.',
            'date2.after_or_equal' => 'A data final deve ser maior ou igual que a data inicial.',
        ];
    }
}
