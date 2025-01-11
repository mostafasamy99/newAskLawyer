<?php

namespace App\Http\Requests\Admin\AboutRequests;

use Illuminate\Foundation\Http\FormRequest;

class AboutStoreRequest extends FormRequest
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
            // 'content' => 'required|string|max:20000',
            'content_ar' => 'required|string|max:20000',
            'content_en' => 'required|string|max:20000',
            'photo' => 'nullable|mimes:jpeg,png,jpg,webp,webm|max:2048',
            'img_dir' => 'required_with:photo|max:2',
            'about_type' => 'nullable|integer|in:1,2,3,4,5',
        ];
    }
}
