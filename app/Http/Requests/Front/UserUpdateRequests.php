<?php

namespace App\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequests extends FormRequest
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
            // 'title'                 => 'required|string|max:255',
            // 'name'                  => 'required|string|max:255',
            // 'email'                 => 'required|email|max:255',
            // 'mobile'                => 'required|string|max:50',

            // 'old_password'            => 'required_with:password|string|min:6',
            // 'password'                => 'required_with:old_password|string|min:6|confirmed',
            // 'password_confirmation'   => 'required|string|min:6',

            'lang'   => 'nullable|in:en,ar',


            'country_id'            => 'nullable|exists:countries,id',
            'city_id'               => 'nullable|exists:cities,id',

            'file'                  => 'nullable|string|max:20000',
            'address'               => 'nullable|string|max:9000',
            'registration_number'   => 'nullable|string|max:255',
            'education'             => 'nullable|string|max:255',
            'memberships'           => 'nullable|string|max:1200',
            'medals'                => 'nullable|string|max:255',
            'disclaimer'            => 'nullable|string|max:1200',
            'legal_fields.*'        => 'nullable|exists:legal_fields,id',
        ];
    }
}
