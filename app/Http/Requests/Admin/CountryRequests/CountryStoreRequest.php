<?php

namespace App\Http\Requests\Admin\CountryRequests;

use Illuminate\Foundation\Http\FormRequest;

class CountryStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public static function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public static function rules()
    {
        return [
            'name_ar' => 'required|string|max:254|unique:country_translations,name',
            'name_en' => 'required|string|max:254|unique:country_translations,name',
        ];
    }
}
