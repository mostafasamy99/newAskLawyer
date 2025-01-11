<?php

namespace App\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;

class PaidRequestStore extends FormRequest
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
            'message' => 'required_without_all:blog_id|string|max:20000',

            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'mobile' => 'nullable|string|max:255',
            // 'lawyer_id' => 'nullable|exists:lawyers,id',
            // 'blog_id' => 'nullable|exists:blogs,id',
            'title' => 'nullable|string|max:1255',
            'files' => 'nullable|array',
            'files.*' => 'nullable|file|max:5000',
        ];
    }
}
