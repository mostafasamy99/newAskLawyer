<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use PhpParser\Node\Expr\Cast\Array_;

class VerifyOtpUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
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
            'otp' => 'required|numeric|digits:4',
        ];
    }


    public function message(): array
    {   
        return[
            'email.required' => __('The email field is required .'),
            'email.email' => __('The email must be a valid email address.'),
            'otp.required' => __('The otp field is required .'),
            'otp.numeric' => __('The otp must be a number.'),
        ];
    }
}
