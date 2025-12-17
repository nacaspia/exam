<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RolesRequest extends FormRequest
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
            'name' => 'required|string',
            'permissions' => 'nullable|array', // permissions array ola bilər
            'permissions.*' => 'integer|exists:permissions,id', // array-dakı hər bir element permission id olmalıdır
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('validation.required'),
            'name.string' => __('validation.string'),
            'permissions.array' => __('validation.array'),
            'permissions.*.integer' => __('validation.integer'),
            'permissions.*.exists' => __('validation.exists'),
        ];
    }

}
