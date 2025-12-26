<?php

namespace App\Http\Services;

use App\Http\Interfaces\IQuestionService;
use App\Models\Language;
use App\Models\Question;
use App\Models\QuestionAnswer;
use App\Models\QuestionOption;
use App\Traits\LoggableTrait;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class QuestionService implements IQuestionService
{
    use LoggableTrait;
    public function getAll(): array
    {

        $data = Question::
        with(['class','subject'])->
        orderBy('id','DESC')->get()->toArray();
        return $data;
    }

    public function find(int $id): array
    {
        return Question::with(['seo','class','subject','options','answer'])->findOrFail($id)->toArray();
    }


    public function create(array $data): bool
    {
        DB::beginTransaction();
        try {

            $title = []; $slug = []; $text = [];
            $languages = Language::where('status',1)->get();

            $model = new Question();
            if (isset($data['image']) && $data['image']->isValid()) {
                $imageName = time() . '_' . $data['image']->getClientOriginalName();
                $path = $data['image']->storeAs('questions', $imageName, 'public');
                $model->image = $path;
            }
            foreach ($languages as $lang) {
                $langCode = isset($lang['code']) ? $lang['code'] : app()->getLocale();
                $title[$langCode] = $data['title'][$langCode];
                $text[$langCode] = $data['text'][$langCode] ?? null;
                $slug[$langCode] = Str::slug(trim($data['title'][$langCode]));
            }
            $model->class_id = $data['class_id'];
            $model->subject_id = $data['subject_id'];
            //$table->enum('type', ['multiple_choice', 'short_text', 'open_text']);
            $model->type = $data['type'];
            $model->is_paid = $data['is_paid'] ?? false;
            if ($model->is_paid) {
                $model->price = $data['price'];
            }
            $model->title = $title;
            $model->slug = $slug;
            $model->text = $text;
            $model->save();

            // 1️⃣ VARIANTLI SUAL
            if ($data['type'] === 'multiple_choice') {
                foreach ($data['options'] as $i => $opt) {
                    $optionSec = [];

                    foreach ($languages as $lang) {
                        $langCode = $lang->code;
                        $optionSec[$langCode] = $opt[$langCode] ?? null;
                    }
                    $option = new QuestionOption();
                    $option->question_id = $model['id'];
                    $option->option = $optionSec;
                    $option->is_correct = ($data['correct_option'] == $i);
                    $option->save();
                }
            }

            // 2️⃣ QISA YAZI
            if ($data['type'] === 'short_text') {
                $questionAnswer = new QuestionAnswer();
                $questionAnswer->question_id = $model['id'];
                $questionAnswer->correct_answer = $data['correct_answer'];
                $questionAnswer->save();
            }
            $model->saveSeo($data);
            DB::commit();

            $this->logAction(
                action: 'create',
                objId: $model->id,
                objTable: 'questions',
                description: "Yeni sual yaradıldı"
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
            $model = Question::findOrFail($id);
            $old   = $model->toArray();

            /* ================= IMAGE ================= */
            if (isset($data['image']) && $data['image']->isValid()) {
                if ($model->image && Storage::disk('public')->exists($model->image)) {
                    Storage::disk('public')->delete($model->image);
                }

                $imageName = time() . '_' . $data['image']->getClientOriginalName();
                $model->image = $data['image']->storeAs('questions', $imageName, 'public');
            }

            /* ================= TRANSLATIONS ================= */
            $title = []; $slug = []; $text = [];
            $languages = Language::where('status', 1)->get();

            foreach ($languages as $lang) {
                $code = $lang->code;
                $title[$code] = $data['title'][$code];
                $text[$code]  = $data['text'][$code] ?? null;
                $slug[$code]  = Str::slug(trim($data['title'][$code]));
            }

            /* ================= MAIN FIELDS ================= */
            $model->subject_id = $data['subject_id'];
            $model->type      = $data['type'];
            $model->title = $title;
            $model->slug  = $slug;
            $model->text  = $text;
            $model->save();

            /* ================= CLEAN OLD DATA ================= */
            $model->options()->delete();
            $model->answer()->delete();

            /* ================= MULTIPLE CHOICE ================= */
            if ($data['type'] === 'multiple_choice') {
                foreach ($data['options'] as $i => $opt) {
                    $optionData = [];

                    foreach ($languages as $lang) {
                        $optionData[$lang->code] = $opt[$lang->code] ?? null;
                    }

                    QuestionOption::create([
                        'question_id' => $model->id,
                        'option'      => $optionData,
                        'is_correct'  => ((int)$data['correct_option'] === (int)$i)
                    ]);
                }
            }

            /* ================= SHORT TEXT ================= */
            if ($data['type'] === 'short_text') {
                QuestionAnswer::create([
                    'question_id'   => $model->id,
                    'correct_answer'=> $data['correct_answer']
                ]);
            }

            /* ================= SEO ================= */
            $model->saveSeo($data);

            DB::commit();

            $this->logAction(
                action: 'update',
                objId: $model->id,
                objTable: 'questions',
                description: json_encode([
                    'old' => $old,
                    'new' => $model->fresh()->toArray()
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
            $model = Question::findOrFail($id);
            $old = $model->toArray();

            // Image varsa sil
            if ($model['image'] && Storage::disk('public')->exists($model['image'])) {
                Storage::disk('public')->delete($model['image']);
            }
            $model->options()->delete();
            $model->answer()->delete();

            // delete role
            $model->delete();
            DB::commit();
            $this->logAction(
                action: 'delete',
                objId: $id,
                objTable: 'subjects',
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
