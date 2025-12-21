<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
        $id = $this->route('languages') ?? null;
        return [
            'title' => 'required|max:100',
            'text' => 'required',
            'facebook'  => 'required|url',
            'instagram'=> 'required|url',
            'telegram' => 'required|url',
            'linkedin' => 'required|url',
            'header_logo' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:2048', // fayl ölçüsü KB ilə
                'dimensions:max_width=122,max_height=29', // tam ölçü
            ],
            'footer_logo' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:2048', // fayl ölçüsü KB ilə
                'dimensions:max_width=122,max_height=29', // tam ölçü
            ],
            'favicon' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:2048', // tam ölçü
            ],
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => __('validation.required'),
//            '*.string' => __('validation.string'),
            '*.url' => __('validation.url'),
            'image.image' => __('validation.image'),
            'image.mimes' => __('validation.mimes'),
            'image.max' => __('validation.max'),
            'image.dimensions' => __('validation.dimensions'),
        ];
    }
}
