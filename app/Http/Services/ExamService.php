<?php

namespace App\Http\Services;

use App\Http\Interfaces\IExamService;
use App\Models\Exam;
use App\Models\Language;
use App\Models\Question;
use App\Models\QuestionAnswer;
use App\Models\QuestionOption;
use App\Traits\LoggableTrait;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ExamService implements IExamService
{
    use LoggableTrait;

    public function getAll(): array
    {
        $data = Exam::orderBy('id', 'DESC')->get()->toArray();
        return $data;
    }

    public function find(int $id): array
    {
        return Exam::with('seo','questions.options','questions.shortAnswer')->findOrFail($id)->toArray();
    }

    public function create(array $data): bool
    {
        DB::beginTransaction();
        try {

            $languages = Language::where('status', 1)->get();

            // =======================
            // 1) EXAM CREATE
            // =======================
            $title = [];
            $slug  = [];
            $text  = [];

            $exam = new Exam();

            if (isset($data['image']) && $data['image']->isValid()) {
                $imageName = time() . '_' . $data['image']->getClientOriginalName();
                $path = $data['image']->storeAs('exams', $imageName, 'public');
                $exam->image = $path;
            }

            foreach ($languages as $lang) {
                $langCode = $lang->code ?? app()->getLocale();
                $title[$langCode] = $data['title'][$langCode] ?? null;
                $text[$langCode]  = $data['text'][$langCode] ?? null;
                $slug[$langCode]  = Str::slug(trim($data['title'][$langCode] ?? ''));
            }

            $exam->user_id = cms_user()->id;
            $exam->class_id = $data['class_id'];
            $exam->language = $data['language'];

            $exam->title = $title;
            $exam->slug = $slug;
            $exam->text = $text;

            $exam->description = $data['description'] ?? null;
            $exam->random_questions = $data['random_questions'] ?? true;
            $exam->show_result = $data['show_result'] ?? true;
            $exam->active = $data['active'] ?? false;

            $exam->price_type = $data['price_type'] ?? 'paid';
            if (($data['price_type'] ?? 'paid') === 'free') {
                $exam->price = 0;
            }
            $exam->is_paid = ($exam->price ?? 0) > 0;
            $exam->duration_type = $data['duration_type'] ?? 'timed';

            if (($data['duration_type'] ?? 'timed') === 'untimed') {
                $exam->duration = null;
                $exam->start_time = null;
                $exam->end_time = null;
            } else {
                $exam->duration = $data['duration'] ?? '';
                $exam->start_time = $data['start_time'] ?? '';
                $exam->end_time = $data['duration_type'] ?? '';
            }

            $exam->save();


            // =======================
            // 2) CREATE QUESTIONS INSIDE EXAM FORM
            // =======================
            $questionIds = [];

            if (!empty($data['questions']) && is_array($data['questions'])) {

                foreach ($data['questions'] as $qData) {

                    $qTitle = [];
                    $qSlug  = [];
                    $qText  = [];

                    $question = new Question();

                    // sual image varsa (optional)
                    if (isset($qData['image']) && $qData['image']->isValid()) {
                        $imageName = time() . '_' . $qData['image']->getClientOriginalName();
                        $path = $qData['image']->storeAs('questions', $imageName, 'public');
                        $question->image = $path;
                    }

                    foreach ($languages as $lang) {
                        $langCode = $lang->code ?? app()->getLocale();
                        $qTitle[$langCode] = $qData['title'][$langCode] ?? null;
                        $qText[$langCode]  = $qData['text'][$langCode] ?? null;
                        $qSlug[$langCode]  = Str::slug(trim($qData['title'][$langCode] ?? ''));
                    }

                    $question->user_id = cms_user()->id;
                    $question->subject_id = $qData['subject_id'] ?? null;
                    $question->type = $qData['type'];
                    $question->title = $qTitle;
                    $question->slug = $qSlug;
                    $question->text = $qText;
                    $question->active = $qData['active'] ?? true;
                    $question->save();

                    // VARIANTLI SUAL
                    if ($qData['type'] === 'multiple_choice') {

                        if (!empty($qData['options']) && is_array($qData['options'])) {

                            foreach ($qData['options'] as $i => $opt) {

                                $optionSec = [];

                                foreach ($languages as $lang) {
                                    $langCode = $lang->code;
                                    $optionSec[$langCode] = $opt[$langCode] ?? null;
                                }

                                $option = new QuestionOption();
                                $option->question_id = $question->id;
                                $option->option = $optionSec;
                                $option->is_correct = ((int)($qData['correct_option'] ?? -1) === (int)$i);
                                $option->save();
                            }
                        }
                    }

                    // QISA YAZI
                    if ($qData['type'] === 'short_text') {
                        $questionAnswer = new QuestionAnswer();
                        $questionAnswer->question_id = $question->id;
                        $questionAnswer->correct_answer = $qData['correct_answer'] ?? null;
                        $questionAnswer->save();
                    }

                    $questionIds[] = $question->id;
                }
            }

            // =======================
            // 3) ATTACH QUESTIONS TO EXAM
            // =======================
            if (!empty($questionIds)) {
                $exam->questions()->sync($questionIds);
            }

            $exam->question_count = count($questionIds);
            $exam->save();

            $exam->saveSeo($data);

            DB::commit();

            $this->logAction(
                action: 'create',
                objId: $exam->id,
                objTable: 'exams',
                description: "Yeni imtahan yaradıldı (suallarla birlikdə)"
            );

            return true;

        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }


    public function update(int $id, array $data): bool
    {
        DB::beginTransaction();

        try {
            $exam = Exam::with('questions.options','questions.shortAnswer')->findOrFail($id);
            $old = $exam->toArray();

            // IMAGE UPDATE
            if (isset($data['image']) && $data['image']->isValid()) {
                if ($exam->image && Storage::disk('public')->exists($exam->image)) {
                    Storage::disk('public')->delete($exam->image);
                }
                $imageName = time() . '_' . $data['image']->getClientOriginalName();
                $exam->image = $data['image']->storeAs('exams', $imageName, 'public');
            }

            // TRANSLATIONS
            $languages = Language::where('status',1)->get();
            $title = $slug = $text = [];
            foreach ($languages as $lang) {
                $code = $lang->code;
                $title[$code] = $data['title'][$code] ?? null;
                $text[$code] = $data['text'][$code] ?? null;
                $slug[$code] = Str::slug(trim($data['title'][$code] ?? ''));
            }

            // MAIN FIELDS
            $exam->class_id = $data['class_id'];
            $exam->language = $data['language'];
            $exam->title = $title;
            $exam->slug = $slug;
            $exam->text = $text;
            $exam->show_result = $data['show_result'] ?? true;
            $exam->active = $data['active'] ?? false;

            $exam->price_type = $data['price_type'] ?? 'paid';
            if (($data['price_type'] ?? 'paid') === 'free') {
                $exam->price = 0;
            }
            $exam->is_paid = ($exam->price ?? 0) > 0;
            $exam->duration_type = $data['duration_type'] ?? 'timed';

            if (($data['duration_type'] ?? 'timed') === 'untimed') {
                $exam->duration = null;
                $exam->start_time = null;
                $exam->end_time = null;
            } else {
                $exam->duration = $data['duration'] ?? '';
                $exam->start_time = $data['start_time'] ?? '';
                $exam->end_time = $data['end_time'] ?? '';
            }

            $exam->save();

            $existingQuestionIds = $exam->questions->pluck('id')->toArray();
            $newQuestionIds = [];

            // HANDLE QUESTIONS
            if (!empty($data['questions']) && is_array($data['questions'])) {
                foreach ($data['questions'] as $qData) {

                    // Update existing question or create new
                    if (!empty($qData['id']) && in_array($qData['id'], $existingQuestionIds)) {
                        $question = Question::findOrFail($qData['id']);
                    } else {
                        $question = new Question();
                        $question->user_id = cms_user()->id;
                    }

                    // QUESTION IMAGE
                    if (isset($qData['image']) && $qData['image']->isValid()) {
                        if ($question->image && Storage::disk('public')->exists($question->image)) {
                            Storage::disk('public')->delete($question->image);
                        }
                        $imageName = time() . '_' . $qData['image']->getClientOriginalName();
                        $question->image = $qData['image']->storeAs('questions', $imageName, 'public');
                    }

                    // TRANSLATIONS
                    $qTitle = $qText = $qSlug = [];
                    foreach ($languages as $lang) {
                        $code = $lang->code;
                        $qTitle[$code] = $qData['title'][$code] ?? null;
                        $qText[$code] = $qData['text'][$code] ?? null;
                        $qSlug[$code] = Str::slug(trim($qData['title'][$code] ?? ''));
                    }

                    $question->subject_id = $qData['subject_id'] ?? null;
                    $question->type = $qData['type'];
                    $question->title = $qTitle;
                    $question->slug = $qSlug;
                    $question->text = $qText;
                    $question->active = $qData['active'] ?? true;
                    $question->save();

                    // MULTIPLE CHOICE OPTIONS
                    if ($qData['type'] === 'multiple_choice') {
                        // Delete old options first
                        $question->options()->delete();

                        if (!empty($qData['options']) && is_array($qData['options'])) {
                            foreach ($qData['options'] as $i => $opt) {
                                $optionSec = [];
                                foreach ($languages as $lang) {
                                    $optionSec[$lang->code] = $opt[$lang->code] ?? null;
                                }

                                $option = new QuestionOption();
                                $option->question_id = $question->id;
                                $option->option = $optionSec;
                                $option->is_correct = ((int)($qData['correct_option'] ?? -1) === (int)$i);
                                $option->save();
                            }
                        }
                    }

                    // SHORT TEXT ANSWER
                    if ($qData['type'] === 'short_text') {
                        $question->shortAnswer()->delete();

                        $answer = new QuestionAnswer();
                        $answer->question_id = $question->id;
                        $answer->correct_answer = $qData['correct_answer'] ?? null;
                        $answer->save();
                    }

                    $newQuestionIds[] = $question->id;
                }
            }

            // REMOVE DELETED QUESTIONS
            $deletedQuestions = array_diff($existingQuestionIds, $newQuestionIds);
            if (!empty($deletedQuestions)) {
                Question::whereIn('id',$deletedQuestions)->delete();
            }

            // SYNC QUESTIONS
            $exam->questions()->sync($newQuestionIds);
            $exam->question_count = count($newQuestionIds);
            $exam->save();

            $exam->saveSeo($data);

            DB::commit();

            $this->logAction(
                action: 'update',
                objId: $exam->id,
                objTable: 'exams',
                description: json_encode([
                    'old' => $old,
                    'new' => $exam->fresh()->toArray()
                ])
            );

            return true;

        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function delete(int $id): bool
    {
        DB::beginTransaction();
        try {
            $model = Exam::findOrFail($id);
            $old = $model->toArray();

            // Image varsa sil
            if ($model['image'] && Storage::disk('public')->exists($model['image'])) {
                Storage::disk('public')->delete($model['image']);
            }

            // delete role
            $model->delete();
            DB::commit();
            $this->logAction(
                action: 'delete',
                objId: $id,
                objTable: 'exams',
                description: json_encode([
                    'old' => $old
                ])
            );

            return true;
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
