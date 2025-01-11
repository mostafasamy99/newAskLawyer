<?php

namespace App\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;

class RequestStore extends FormRequest
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
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'title' => 'required|string|max:1255',
            'message' => 'required|string|max:20000',

            'service_id' => 'required|exists:services,id',
            'lawyer_id' => 'nullable|exists:lawyers,id',
            'country_id' => 'required|exists:countries,id',
        ];
    }
}
