<?php

namespace App\Http\Requests\LawyerRequests;

use Illuminate\Foundation\Http\FormRequest;

class LawyerStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; 
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:lawyers,name',
            'email' => 'required|string|max:255|unique:lawyers,email',
            'mobile' => 'required|string|max:255|unique:lawyers,mobile',
            'title' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'linked_in' => 'nullable|string|max:255',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,webp,webm|max:2048',
            'photo_union_card' => 'nullable|image|mimes:jpeg,png,jpg,webp,webm|max:2048',
            'country_id' => 'required|exists:countries,id',
            'city_id' => 'required|exists:cities,id',
            'file' => 'required|string|max:20000',
            'services.*' => 'required|exists:services,id',
            'languages.*' => 'required|exists:languages,id',
            'legal_fields.*' => 'required|exists:legal_fields,id',
            'password' => 'required|confirmed|min:6|max:30',
            'password_confirmation' => 'required|same:password|max:30',

            'type' => 'required|in:1,3',
            'registration_number' => 'nullable|numeric|unique:lawyers,registration_number',
            'education' => 'nullable|string|max:255',
            'medals' => 'nullable|string|max:255',
            'website_company' => 'nullable|url|unique:lawyers,website_company',
            'country_id_company' => 'nullable|exists:countries,id',
            'city_id_company' => 'nullable|exists:cities,id',
            'linked_in_company' => 'nullable|string|max:255',
            'address_company' => 'nullable|string|max:255',
            'photo_office_rent' => 'nullable|image|mimes:jpeg,png,jpg,webp,webm|max:2048',
            'photo_passport' => 'nullable|image|mimes:jpeg,png,jpg,webp,webm|max:2048',
        ];
    }
}
