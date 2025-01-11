<?php

namespace App\Http\Requests\Admin\SubjectRequests;

use Illuminate\Foundation\Http\FormRequest;

class SubjectUpdateRequest extends FormRequest
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
            // 'name' => 'required|string|max:254|unique:subjects,name,' . $id,
            'name_ar' => 'required|string|max:254|unique:subject_translations,name,' . $id . ',subject_id',
            'name_en' => 'required|string|max:254|unique:subject_translations,name,' . $id . ',subject_id',
            'logo' => 'nullable|mimes:jpeg,png,jpg,webp,webm,svg|max:2048',
        ];
    }
}
