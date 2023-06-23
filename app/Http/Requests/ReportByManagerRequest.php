<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReportByManagerRequest extends FormRequest
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
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'user_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'start_date.required' => 'O campo data inicial é obrigatório.',
            'end_date.required' => 'O campo data final é obrigatório.',
            'end_date.after' => 'A data final deve ser maior que a data inicial.',
            'user_id.required' => 'O campo responsável é obrigatório.',
        ];
    }
}
