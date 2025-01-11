<?php

namespace App\Http\Requests\LawyerRequests;

use Illuminate\Foundation\Http\FormRequest;

class LawyerUpdateRequest extends FormRequest
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
            'name' => 'required|string|max:254|unique:lawyers,name,' . $id,
            'email' => 'required|string|max:254|unique:lawyers,email,' . $id,
            'mobile' => 'required|string|max:254|unique:lawyers,mobile,' . $id,
            'title' => 'required|string|max:254',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,webp,webm|max:2048',
            'country_id' => 'required|exists:countries,id',
            'city_id' => 'required|exists:cities,id',
            // 'lang_id' => 'required|exists:languages,id',
            'file' => 'required|string|max:20000',
            'services.*' => 'required|exists:services,id',
            'languages.*' => 'required|exists:languages,id',
        ];
    }
}
