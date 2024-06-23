<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveQuotationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'age' => 'required|string',
            'currency_id' => 'required|in:EUR,GBP,USD',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ];
    }
}
