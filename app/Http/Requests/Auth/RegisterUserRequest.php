<?php

namespace App\Http\Requests\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Http\FormRequest;


class RegisterUserRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Allow this request for all users
    }

    public function rules()
    {
        return [
            'email' => [
                'required',
                'email',
                function ($attribute, $value, $fail) {
                    $userExists = DB::table('users')->where('email', $value)->exists();
                    $lawyerExists = DB::table('lawyers')->where('email', $value)->exists();

                    if ($userExists) {
                        $fail('The email is already taken by a user.');
                    }

                    if ($lawyerExists) {
                        $fail('The email is already taken by a lawyer.');
                    }
                },
            ],
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|same:password|min:8|max:30',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => __('The email field is required.'),
            'email.email' => __('The email must be a valid email address.'),
            'password.required' => __('The password field is required.'),
            'password.min' => __('The password must be at least 8 characters.'),
            'password.confirmed' => __('The password confirmation does not match.'),
            'password_confirmation.required' => __('The password confirmation field is required.'),
            'password_confirmation.same' => __('The password confirmation does not match.'),
            'password_confirmation.min' => __('The password confirmation must be at least 8 characters.'),
            'password_confirmation.max' => __('The password confirmation may not be greater than 30 characters.'),
        ];
    }
}
