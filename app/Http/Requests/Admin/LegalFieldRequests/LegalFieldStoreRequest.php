<?php

namespace App\Http\Requests\Admin\LegalFieldRequests;

use Illuminate\Foundation\Http\FormRequest;

class LegalFieldStoreRequest extends FormRequest
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
            // 'name' => 'required|string|max:254|unique:legal_fields,name'
            'name_ar' => 'required|string|max:254|unique:legal_field_translations,name',
            'name_en' => 'required|string|max:254|unique:legal_field_translations,name',
        ];
    }
}
