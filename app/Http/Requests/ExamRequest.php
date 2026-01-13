<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExamRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            /* ================= IMAGE ================= */
            'image' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:4096',
            ],

            /* ================= MAIN ================= */
            'class_id' => 'required|integer|exists:school_classes,id',
            'language' => 'required|string|max:10',

            'duration' => 'required|integer|min:1',
            'question_count' => 'required|integer|min:1',

            'price' => 'nullable|numeric|min:0',
            'is_paid' => 'boolean',

            /* ================= TRANSLATIONS ================= */
            'title' => 'required|array',
            'title.*' => 'required|string|max:200',

            'text' => 'nullable|array',
            'text.*' => 'nullable|string',

            /* ================= FLAGS ================= */
            'random_questions' => 'boolean',
            'show_result' => 'boolean',
            'active' => 'boolean',

            /* ================= TIME ================= */
            'start_time' => 'nullable|date',
            'end_time'   => 'nullable|date|after:start_time',

            /* ================= DESCRIPTION ================= */
            'description' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => __('validation.required'),
            '*.string' => __('validation.string'),
            '*.integer' => __('validation.integer'),
            '*.boolean' => __('validation.boolean'),
            '*.numeric' => __('validation.numeric'),
            '*.array' => __('validation.array'),
            '*.min' => __('validation.min'),
            '*.max' => __('validation.max'),
            '*.date' => __('validation.date'),
            '*.after' => __('validation.after'),

            'class_id.exists' => __('validation.exists'),
            'duration.min' => __('İmtahan müddəti minimum 1 dəqiqə olmalıdır'),
            'question_count.min' => __('Minimum 1 sual seçilməlidir'),
        ];
    }
}
