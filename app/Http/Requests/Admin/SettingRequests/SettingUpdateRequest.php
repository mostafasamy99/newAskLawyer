<?php

namespace App\Http\Requests\Admin\SettingRequests;

use Illuminate\Foundation\Http\FormRequest;

class SettingUpdateRequest extends FormRequest
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
        // $id = $this->route('id'); // get from route
        // $id = $this->request->get('user_id'); // get from in blade
        return [
            'mobile' => 'required|string|max:254',
            'email' => 'required|string|max:254',
            'website_logo' => 'nullable|mimes:jpeg,png,jpg,webp,webm|max:2048',
            'location' => 'nullable|string|max:1254',
            'facebook' => 'nullable|string|max:254',
            'whats' => 'nullable|string|max:254',
            'insta' => 'nullable|string|max:254',
            'app_url' => 'nullable|string|max:1254',
        ];
    }
}
