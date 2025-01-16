<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class OtpCheckRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Update if authorization is required
    }

    public function rules()
    {
        return [
            'email' => 'required|email|exists:lawyers,email',
            'otp' => 'required|numeric',
        ];
    }
    
    public function messages()
    {
        return [
            'email.required' => __('The email field is required.'),
            'email.email' => __('The email must be a valid email address.'),
            'email.exists' => __('No lawyer found with this email address.'),
            'otp.required' => __('The OTP field is required.'),
            'otp.numeric' => __('The OTP must be a number.'),
        ];
    }
}
