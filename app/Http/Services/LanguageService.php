<?php

namespace App\Http\Services;

use App\Http\Interfaces\ILanguageService;
use App\Models\Language;
use App\Traits\LoggableTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class LanguageService implements ILanguageService
{

    use LoggableTrait;

    public function getAll(): array
    {
        $data = Language::where(['status' => true])->orderBy('name','ASC')->get()->toArray();
        return $data;
    }

    public function find(int $id): array
    {
        return Language::findOrFail($id)->toArray();
    }
    public function getByDefault(): array
    {
        return Language::where(['status' => true, 'is_default' => true])->firts()->toArray();
    }

    public function create(array $data): bool
    {
        DB::beginTransaction();
        try {
            $model = new Language();
            $code = strtolower($data['code']);

            if (!empty($data['is_default'])) {
                $isDefault = self::getByDefault();
                if (!empty($isDefault)) { return false; }
            }
            $model->name = $data['name'];
            $model->code = $code;
            $model->is_default = $data['is_default'] ?? false;
            $model->save();

            $defaultLangPath = resource_path('lang/az/site.php');
            $newLangDir = resource_path("lang/{$code}");
            $newLangFile = $newLangDir . '/site.php';

            // Folder yoxdursa yarat
            if (!File::exists($newLangDir)) {
                File::makeDirectory($newLangDir, 0755, true);
            }

            // Default az/site.php varsa — onu kopyala
            if (File::exists($defaultLangPath)) {
                File::copy($defaultLangPath, $newLangFile);
            } else {
                // fallback (ehtiyat variant)
                File::put($newLangFile, "<?php\n\nreturn [];");
            }

            DB::commit();
            $this->logAction(
                action: 'create',
                objId: $model->id,
                objTable: 'languages',
                description: "Yeni dil yaradıldı: {$model->name}"
            );
            return true;

        } catch (Exception $e) {
            DB::rollBack();
            // Əgər DB rollback olduysa, yarımçıq file qalmasın
            if (isset($path) && File::exists($path)) {
                File::deleteDirectory($path);
            }
            throw $e;
        }
    }

    public function update(int $id, array $data): bool
    {
        DB::beginTransaction();

        try {
            $model = self::find($id);
            $oldCode = $model['code'];
            $newCode = strtolower($data['code']);

            if (!empty($data['is_default'])) {
                $isDefault = self::getByDefault();
                if (!empty($isDefault)) {
                    throw new \Exception('Default dil artıq vardır');
                }
            }

            if ($oldCode !== $newCode) {
                $oldPath = resource_path("lang/{$oldCode}");
                $newPath = resource_path("lang/{$newCode}");

                if (File::exists($oldPath)) {
                    File::move($oldPath, $newPath);
                }
            }

            $model->update([
                'name'       => $data['name'],
                'code'       => $newCode,
                'is_default' => $data['is_default'] ?? false,
            ]);

            DB::commit();
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
            $model = self::find($id);

            if ($model['is_default']) {
                throw new \Exception('Default dili silmək olmaz');
            }

            $path = resource_path("lang/{$model['code']}");
            $model->delete();
            if (File::exists($path)) {
                File::deleteDirectory($path);
            }

            DB::commit();
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
            if ($model['is_default']) {
                throw new \Exception('Default dilin statusunu dəyişmək olmaz');
            }
            $model->status = $status ?? false;
            $model->save();
            DB::commit();
            return true;

        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
