<?php

namespace App\Http\Requests\Admin\LanguageRequests;

use Illuminate\Foundation\Http\FormRequest;

class LanguageStoreRequest extends FormRequest
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
            // 'name' => 'required|string|max:254|unique:languages,name'
            'name_ar' => 'required|string|max:254|unique:language_translations,name',
            'name_en' => 'required|string|max:254|unique:language_translations,name',
        ];
    }
}
