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
            // Image
            'image' => ['nullable','image','mimes:jpeg,png,jpg,gif,svg'],

            // Main
            'class_id' => 'required|integer|exists:school_classes,id',
            'language' => 'required|string|max:10',

            // Price
            'price_type' => 'required|in:paid,free',
            'price' => 'nullable|numeric|min:0|required_if:price_type,paid',
            'is_paid' => 'boolean',

            // Duration
            'duration_type' => 'required|in:timed,untimed',
            'duration' => 'nullable|integer|min:1|required_if:duration_type,timed',
            'start_time' => 'nullable|date|required_if:duration_type,timed',
            'end_time' => 'nullable|date|after:start_time|required_if:duration_type,timed',

            // Translations
            'title' => 'required|array',
            'title.*' => 'required|string|max:200',
            'text' => 'nullable|array',
            'text.*' => 'nullable|string',

            // Flags
            'show_result' => 'boolean',
            'active' => 'boolean',

            // Description
            'description' => 'nullable|string',

            // Questions (dynamic)
            'questions' => 'required|array|min:1',
            'questions.*.title' => 'required|array',
            'questions.*.title.*' => 'required|string|max:200',
            'questions.*.text' => 'nullable|array',
            'questions.*.text.*' => 'nullable|string',
            'questions.*.type' => 'required|in:multiple_choice,short_text',
            'questions.*.subject_id' => 'required|integer|exists:subjects,id',
            'questions.*.correct_answer' => 'nullable|string', // short_text üçün
            'questions.*.options' => 'nullable|array', // multiple_choice üçün
            'questions.*.options.*.*' => 'required_with:questions.*.options|string|max:200',
            'questions.*.correct_option' => 'nullable|integer', // multiple_choice üçün
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
            'questions.required' => 'Ən azı 1 sual əlavə edilməlidir.',
            'questions.*.title.*.required' => 'Hər sualın başlığı doldurulmalıdır.',
            'questions.*.options.*.*.required_with' => 'Variantlar doldurulmalıdır.',
            'duration.min' => 'İmtahan müddəti minimum 1 dəqiqə olmalıdır',
        ];
    }
}
