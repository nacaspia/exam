<?php

namespace App\Http\Services;

use App\Http\Interfaces\IExamService;
use App\Models\Exam;
use App\Models\Language;
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
        return Exam::with(['seo', 'class', 'questions'])->findOrFail($id)->toArray();
    }


    public function create(array $data): bool
    {
        DB::beginTransaction();
        try {

            $title = [];
            $slug = [];
            $text = [];
            $languages = Language::where('status', 1)->get();

            $model = new Exam();
            if (isset($data['image']) && $data['image']->isValid()) {
                $imageName = time() . '_' . $data['image']->getClientOriginalName();
                $path = $data['image']->storeAs('exams', $imageName, 'public');
                $model->image = $path;
            }
            foreach ($languages as $lang) {
                $langCode = isset($lang['code']) ? $lang['code'] : app()->getLocale();
                $title[$langCode] = $data['title'][$langCode];
                $text[$langCode] = $data['text'][$langCode] ?? null;
                $slug[$langCode] = Str::slug(trim($data['title'][$langCode]));
            }
            $model->user_id = cms_user()->id;
            $model->class_id = $data['class_id'];
            $model->language = $data['language'];
            $model->price = $data['price'] ?? 0;
            $model->is_paid = ($data['price'] ?? 0) > 0;
            $model->title = $title;
            $model->slug = $slug;
            $model->text = $text;
            $model->duration = $data['duration'];
            $model->start_time = $data['start_time'];
            $model->end_time = $data['end_time'];
            $model->description = $data['description'];
            $model->question_count = count($data['question_ids']);
            $model->random_questions = $data['random_questions'] ?? true;
            $model->show_result = $data['show_result'] ?? true;
            $model->active =  $data['active'] ?? false;
            $model->save();

            // Exam save-dən SONRA
            if (!empty($data['question_ids']) && is_array($data['question_ids'])) {
                $model->questions()->sync($data['question_ids']);
            }

            $model->saveSeo($data);
            DB::commit();

            $this->logAction(
                action: 'create',
                objId: $model->id,
                objTable: 'exams',
                description: "Yeni imtahan yaradıldı"
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
            $model = Exam::findOrFail($id);
            $old = $model->toArray();

            /* ================= IMAGE ================= */
            if (isset($data['image']) && $data['image']->isValid()) {
                if ($model->image && Storage::disk('public')->exists($model->image)) {
                    Storage::disk('public')->delete($model->image);
                }

                $imageName = time() . '_' . $data['image']->getClientOriginalName();
                $model->image = $data['image']->storeAs('exams', $imageName, 'public');
            }

            /* ================= TRANSLATIONS ================= */
            $title = [];
            $slug = [];
            $text = [];
            $languages = Language::where('status', 1)->get();

            foreach ($languages as $lang) {
                $code = $lang->code;
                $title[$code] = $data['title'][$code];
                $text[$code] = $data['text'][$code] ?? null;
                $slug[$code] = Str::slug(trim($data['title'][$code]));
            }

            /* ================= MAIN FIELDS ================= */
            $model->class_id = $data['class_id'];
            $model->language = $data['language'];
            $model->price = $data['price'] ?? 0;
            $model->is_paid = ($data['price'] ?? 0) > 0;
            $model->title = $title;
            $model->slug = $slug;
            $model->text = $text;
            $model->duration = $data['duration'];
            $model->question_count = count($data['question_ids']);
            $model->random_questions = $data['random_questions'] ?? true;
            $model->show_result = $data['show_result'] ?? true;
            $model->active = $data['active'] ?? false;
            $model->save();

            if (!empty($data['question_ids']) && is_array($data['question_ids'])) {
                $model->questions()->sync($data['question_ids']);
            }


            $model->saveSeo($data);

            DB::commit();

            $this->logAction(
                action: 'update',
                objId: $model->id,
                objTable: 'exams',
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
