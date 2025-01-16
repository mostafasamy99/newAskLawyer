<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use PhpParser\Node\Expr\Cast\Array_;

class LoginCheckRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
            'user_type' => 'required|in:1,2', // 1: Lawyer, 2: User
        ];
    }


    public function message():Array
    {
        return [
            'email.required' => __('The email field is required.'),
            'email.email' => __('The email must be a valid email address.'),
            'password.required' => __('The password field is required.'),
            'user_type.required' => __('The user type field is required.'),
            'user_type.in' => __('The user type must be 1 or 2.'),
        ];        
    }
}
