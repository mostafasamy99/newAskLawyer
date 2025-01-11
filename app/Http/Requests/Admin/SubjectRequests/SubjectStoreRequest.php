<?php

namespace App\Http\Requests\Admin\SubjectRequests;

use Illuminate\Foundation\Http\FormRequest;

class SubjectStoreRequest extends FormRequest
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
            // 'name' => 'required|string|max:254|unique:subjects,name',
            'name_ar' => 'required|string|max:254|unique:subject_translations,name',
            'name_en' => 'required|string|max:254|unique:subject_translations,name',
            'logo' => 'required|mimes:jpeg,png,jpg,webp,webm,svg|max:2048',
        ];
    }
}
