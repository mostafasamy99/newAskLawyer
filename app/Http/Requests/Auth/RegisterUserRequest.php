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
}
