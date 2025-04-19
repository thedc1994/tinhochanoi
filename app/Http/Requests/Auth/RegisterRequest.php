<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true; // Cho phép tất cả ai gọi cũng được xử lý
    }

    public function rules(): array
    {
        return [
            'first-name' => ['required', 'string', 'max:255'],
            'last-name'  => ['required', 'string', 'max:255'],
            'username'   => ['required', 'string', 'max:255', 'unique:users,username'],
            'email'      => ['nullable','string', 'email', 'max:255', 'unique:users,email'],
            'phone'      => ['nullable', 'string', 'max:20'],
            'password'   => ['required', 'string', 'min:8', 'confirmed'], // password_confirmation
            'toc'        => ['accepted'],
        ];
    }

    public function attributes(): array
    {
        return [
            'first-name'            => __('auth.first_name'),
            'last-name'             => __('auth.last_name'),
            'username'              => __('auth.username'),
            'email'                 => __('auth.email'),
            'phone'                 => __('auth.phone'),
            'password'              => __('auth.password'),
            'password_confirmation' => __('auth.confirm_password'),
            'toc'                   => __('auth.terms_and_conditions'),
        ];
    }
}
