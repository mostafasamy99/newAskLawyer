<?php

namespace App\Http\Requests\Front\auth\lawyer;

use Illuminate\Foundation\Http\FormRequest;

class CheckOtpLawyerRequest extends FormRequest
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
            'n1' => 'required|numeric',
            'n2' => 'required|numeric',
            'n3' => 'required|numeric',
            'n4' => 'required|numeric'
        ];
    }
}
