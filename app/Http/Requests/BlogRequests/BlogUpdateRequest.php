<?php

namespace App\Http\Requests\BlogRequests;

use Illuminate\Foundation\Http\FormRequest;

class BlogUpdateRequest extends FormRequest
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
    public function rules()
    {
        $id = $this->route('id'); // get from route
        // $id = $this->request->get('user_id'); // get from in blade
        return [
            'title_ar' => 'nullable|string|max:254|unique:blog_translations,title,'. $id .',blog_id',
            'title_en' => 'nullable|string|max:254|unique:blog_translations,title,'. $id .',blog_id',
            'description_ar' => 'nullable|string|max:1200',
            'description_en' => 'nullable|string|max:1200',
            'content_ar' => 'nullable|string|max:20000',
            'content_en' => 'nullable|string|max:20000',
            
            'country_id' => 'required|exists:countries,id',
            'photo' => 'nullable|mimes:jpeg,png,jpg,webp,webm|max:2048',
            'section_id' => 'required|exists:sections,id',
            'service_id' => 'required|exists:services,id',
            'subject_id' => 'required|exists:subjects,id',
            'is_favorite' => 'nullable|integer|in:1',
            'is_fixed_service' => 'nullable|integer|in:1',
            'order' => 'nullable|integer',
            'price' => 'nullable|integer',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            !$this->input('title_ar') && !$this->input('title_en') ? $validator->errors()->add('title_ar', __('validation.required_without', ['attribute' => 'title_ar', 'values' => 'title_en'])) : '';
            !$this->input('description_ar') && !$this->input('description_en') ? $validator->errors()->add('description_ar', __('validation.required_without', ['attribute' => 'description_ar', 'values' => 'description_en'])) : '';
            !$this->input('content_ar') && !$this->input('content_en') ? $validator->errors()->add('content_ar', __('validation.required_without', ['attribute' => 'content_ar', 'values' => 'content_en'])) : '';
        });
    }
}
