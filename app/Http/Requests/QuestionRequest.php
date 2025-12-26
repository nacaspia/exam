<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
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
            'image' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:2048', // fayl ölçüsü KB ilə
                'dimensions:max_width=270,max_height=230', // tam ölçü
            ],
            'subject_id' => 'required|integer|exists:subjects,id',
            'title' => 'required|array',
            'title.*' => 'required|string|max:200',
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
            'phone.regex' => __('validation.phone'),
            'image.image' => __('validation.image'),
            'image.mimes' => __('validation.mimes'),
            'image.max' => __('validation.max'),
            'image.dimensions' => __('validation.dimensions'),
        ];
    }
}
