<?php

namespace App\Http\Requests\Admin\CityRequests;

use Illuminate\Foundation\Http\FormRequest;

class CityUpdateRequest extends FormRequest
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
            // 'name' => 'required|string|max:254|unique:cities,name,' . $id,
            'name_ar' => 'required|string|max:254|unique:city_translations,name,' . $id . ',city_id',
            'name_en' => 'required|string|max:254|unique:city_translations,name,' . $id . ',city_id',
            'country_id' => 'required|exists:countries,id'
        ];
    }
}
