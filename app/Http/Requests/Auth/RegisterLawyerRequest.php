<?php

namespace App\Http\Requests\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Http\FormRequest;

class RegisterLawyerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Adjust authorization logic if needed
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    $userExists = DB::table('users')->where('email', $value)->exists();
                    $lawyerExists = DB::table('lawyers')->where('email', $value)->exists();

                    if ($userExists) {
                        return $fail('The email is already taken by a user.');
                    }

                    if ($lawyerExists) {
                        return $fail('The email is already taken by a lawyer.');
                    }
                },
            ],
            'mobile' => 'required|string|max:255|unique:lawyers,mobile',
            'title' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'linked_in' => 'nullable|string|max:255',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,webp,webm|max:2048',
            'photo_union_card' => 'nullable|image|mimes:jpeg,png,jpg,webp,webm|max:2048',
            'country_id' => 'required|exists:countries,id',
            'city_id' => 'required|exists:cities,id',
            'file' => 'nullable|mimes:pdf,doc,docx|max:20000',
            'services.*' => 'nullable|exists:services,id',
            'languages.*' => 'required|exists:languages,id',
            'legal_fields.*' => 'required|exists:legal_fields,id',
            'password' => 'required|confirmed|min:6|max:30',
            'password_confirmation' => 'required|same:password|max:30',
            'type' => 'required|in:1,3',
            'registration_number' => 'nullable|numeric|unique:lawyers,registration_number',
            'education' => 'nullable|string|max:255',
            'medals' => 'nullable|string|max:255',
            'website_company' => 'nullable|url',
            'country_id_company' => 'nullable|exists:countries,id',
            'city_id_company' => 'nullable|exists:cities,id',
            'linked_in_company' => 'nullable|string|max:255',
            'address_company' => 'nullable|string|max:255',
            'photo_office_rent' => 'nullable|image|mimes:jpeg,png,jpg,webp,webm|max:2048',
            'photo_passport' => 'nullable|image|mimes:jpeg,png,jpg,webp,webm|max:2048',
            'name_company' => 'nullable|string|max:255',
            'bio_company' => 'nullable|string',
            'card_id_img' => 'nullable|image|mimes:jpeg,png,jpg,webp,webm|max:2048',
        ];
    }

    /**
     * Custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
        ];
    }
}
