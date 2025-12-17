<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CmsRequest extends FormRequest
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
        $id = $this->route('cms_user') ?? null;
        return [
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'string|required|max:100',
            'surname' => 'string|required|max:100',
            'username' => 'string|required|max:100|unique:cms_users,username,'.$id,
            'phone' => 'string|required|max:100|regex:/^([0-9\s\-\+\(\)]*)$/|unique:cms_users,phone,'.$id,
            'email' => 'email|required|max:100|unique:cms_users,email,'.$id,
            'pin' => 'string|max:100|unique:cms_users,pin,'.$id,
            'birthday' => 'date|date_format:Y-m-d',
            'password' => 'nullable|string|max:100',
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
            'image.image' => __('validation.image'),
            'image.mimes' => __('validation.mimes'),
            'image.max' => __('validation.max'),
        ];
    }
}
