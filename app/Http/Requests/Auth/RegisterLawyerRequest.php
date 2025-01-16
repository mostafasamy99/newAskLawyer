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
            'name.required' => __('The name field is required.'),
            'name.string' => __('The name must be a string.'),
            'name.max' => __('The name may not be greater than 255 characters.'),
            'email.required' => __('The email field is required.'),
            'email.string' => __('The email must be a string.'),
            'email.max' => __('The email may not be greater than 255 characters.'),
            'email.unique' => __('The email has already been taken.'),
            'mobile.required' => __('The mobile field is required.'),
            'mobile.string' => __('The mobile must be a string.'),
            'mobile.max' => __('The mobile may not be greater than 255 characters.'),
            'mobile.unique' => __('The mobile has already been taken.'),
            'title.required' => __('The title field is required.'),
            'title.string' => __('The title must be a string.'),
            'title.max' => __('The title may not be greater than 255 characters.'),
            'address.string' => __('The address must be a string.'),
            'address.max' => __('The address may not be greater than 255 characters.'),
            'linked_in.string' => __('The linked in must be a string.'),
            'linked_in.max' => __('The linked in may not be greater than 255 characters.'),
            'img.image' => __('The img must be an image.'),
            'img.mimes' => __('The img must be a file of type: jpeg, png, jpg, webp, webm.'),
            'img.max' => __('The img may not be greater than 2048 kilobytes.'),
            'photo_union_card.image' => __('The photo union card must be an image.'),
            'photo_union_card.mimes' => __('The photo union card must be a file of type: jpeg, png, jpg'),
        ];
    }
}
