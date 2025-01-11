<?php

namespace App\Http\Requests\Admin\ProcesStepRequests;

use Illuminate\Foundation\Http\FormRequest;

class ProcesStepUpdateRequest extends FormRequest
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
            'name' => 'required|string|max:254|unique:procesSteps,name,' . $id
        ];
    }
}
