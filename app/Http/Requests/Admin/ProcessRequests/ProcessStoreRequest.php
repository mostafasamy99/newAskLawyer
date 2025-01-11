<?php

namespace App\Http\Requests\Admin\ProcessRequests;

use Illuminate\Foundation\Http\FormRequest;

class ProcessStoreRequest extends FormRequest
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
            'content' => 'nullable|string|max:20000|unique:process,content',
            'photo' => 'nullable|mimes:jpeg,png,jpg,webp,webm|max:2048',
            'img_dir' => 'required_with:photo|max:2',
            'proces_steps.*.content_ar' => 'required|string|max:255',
            'proces_steps.*.content_en' => 'required|string|max:255'
        ];
    }
}
