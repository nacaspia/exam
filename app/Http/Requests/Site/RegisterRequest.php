<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
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
            'name' => 'required|string|max:100',
            'surname' => 'required|string|max:100',
            'phone' => 'required|string|max:100|regex:/^([0-9\s\-\+\(\)]*)$/|unique:cms_users,phone',
            'email' => 'required|email|max:100|unique:cms_users,email',
            'password' => 'required|string|min:8',
            're_password' => 'required|string|min:8|same:password',
            'status' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => __('validation.required'),
            '*.string' => __('validation.string'),
            '*.integer' => __('validation.integer'),
            '*.boolean' => __('validation.boolean'),
            '*.email' => __('validation.email'),
            'phone.regex' => __('validation.phone'),
            'password.same' => __('validation.same'),
            'password.min' => __('validation.max'),
        ];
    }
}
