<?php

namespace App\Http\Services;

use App\Http\Interfaces\ISubjectService;
use App\Models\Language;
use App\Models\Subject;
use App\Traits\LoggableTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SubjectService implements ISubjectService
{
    use LoggableTrait;

    public function getAll(): array
    {
        $data = Subject::orderBy('id','DESC')->get()->toArray();
        return $data;
    }

    public function find(int $id): array
    {
        return Subject::with('seo')->findOrFail($id)->toArray();
    }

    public function create(array $data): bool
    {
        DB::beginTransaction();
        try {

            $title = []; $slug = []; $text = [];
            $languages = Language::where('status',1)->get();

            $model = new Subject();
            if (isset($data['image']) && $data['image']->isValid()) {
                $imageName = time() . '_' . $data['image']->getClientOriginalName();
                $path = $data['image']->storeAs('subjects', $imageName, 'public');
                $model->image = $path;
            }
            foreach ($languages as $lang) {
                $langCode = isset($lang['code']) ? $lang['code'] : app()->getLocale();
                $title[$langCode] = $data['title'][$langCode];
                $text[$langCode] = $data['text'][$langCode] ?? null;
                $slug[$langCode] = Str::slug(trim($data['title'][$langCode]));
            }
            $model->name = $title;
            $model->slug = $slug;
            $model->text = $text;
            $model->save();
            $model->saveSeo($data);
            DB::commit();

            $this->logAction(
                action: 'create',
                objId: $model->id,
                objTable: 'subjects',
                description: "Yeni fənn yaradıldı"
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
            $model = Subject::findOrFail($id);
            $old = $model->toArray();
            // Image update
            if (isset($data['image']) && $data['image']->isValid()) {

                // Köhnə image varsa, sil
                if ($model['image'] && Storage::disk('public')->exists($model['image'])) {
                    Storage::disk('public')->delete($model['image']);
                }

                $imageName = time() . '_' . $data['image']->getClientOriginalName();
                $path = $data['image']->storeAs('school_classes', $imageName, 'public');
                $model->image = $path;
            }
            $title = []; $slug = []; $text = [];
            $languages = Language::where('status',1)->get();
            foreach ($languages as $lang) {
                $langCode = isset($lang['code']) ? $lang['code'] : app()->getLocale();
                $title[$langCode] = $data['title'][$langCode];
                $text[$langCode] = $data['text'][$langCode];
                $slug[$langCode] = Str::slug(trim($data['title'][$langCode]));
            }
            $model->title = $title;
            $model->slug = $slug;
            $model->text = $text;
            $model->save();
            $model->saveSeo($data);

            DB::commit();
            $this->logAction(
                action:'update',
                objId: $model->id,
                objTable: 'subjects',
                description: json_encode([
                    'old' => $old,
                    'new' => $model
                ])
            );

            return true;

        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function delete(int $id): bool
    {
        DB::beginTransaction();
        try {
            $model = Subject::findOrFail($id);
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

    public function status(int $id, bool $status): bool
    {
        DB::beginTransaction();
        try {
            $model = self::find($id);
            $old = $model;
            $model->status = $status ?? false;
            $model->save();
            DB::commit();
            $this->logAction(
                action: 'delete',
                objId: $id,
                objTable: 'subjects',
                description: json_encode([
                    'old' => $old,
                    'new' => $model
                ])
            );
            return true;

        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
