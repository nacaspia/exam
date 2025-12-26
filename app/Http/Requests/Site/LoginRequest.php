<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|max:100',
            'password' => 'required|string|min:8'
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => __('validation.required'),
            '*.string' => __('validation.string'),
            '*.email' => __('validation.email'),
            'phone.regex' => __('validation.phone'),
            'password.min' => __('validation.max'),
        ];
    }
}
