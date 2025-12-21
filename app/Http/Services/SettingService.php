<?php

namespace App\Http\Services;

use App\Http\Interfaces\ISettingService;
use App\Models\Language;
use App\Models\Setting;
use App\Traits\LoggableTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SettingService implements ISettingService
{
    use LoggableTrait;
    public function find(): array
    {
        return Setting::first()?->toArray() ?? [];
    }

    public function create(array $data): bool
    {
        DB::beginTransaction();
        try {

            $title = [];  $text = [];
            $languages = Language::where('status',1)->get();

            $model = new Setting();
            if (isset($data['header_logo']) && $data['header_logo']->isValid()) {
                $headerLogoName = time() . '_' . $data['header_logo']->getClientOriginalName();
                $headerLogoPath = $data['header_logo']->storeAs('settings', $headerLogoName, 'public');
            }
            if (isset($data['footer_logo']) && $data['footer_logo']->isValid()) {
                $footerLogoName = time() . '_' . $data['footer_logo']->getClientOriginalName();
                $footerLogoPath = $data['footer_logo']->storeAs('settings', $footerLogoName, 'public');
            }
            if (isset($data['favicon']) && $data['favicon']->isValid()) {
                $faviconLogoName = time() . '_' . $data['favicon']->getClientOriginalName();
                $faviconLogoPath = $data['favicon']->storeAs('settings', $faviconLogoName, 'public');
            }

            foreach ($languages as $lang) {
                $langCode = isset($lang['code']) ? $lang['code'] : app()->getLocale();
                $title[$langCode] = $data['title'][$langCode];
                $text[$langCode] = $data['text'][$langCode] ?? null;
            }
            $logo = [
                'header_logo' => $headerLogoPath,
                'footer_logo' => $footerLogoPath,
                'favicon' => $faviconLogoPath,
            ];
            $contact = [
                'facebook' => $data['facebook'],
                'instagram' => $data['facebook'],
                'telegram' => $data['telegram'],
                'linkedin' => $data['linkedin'],
            ];

            $model->title = $title;
            $model->text = $text;
            $model->logo = $logo;
            $model->contact = $contact;
            $model->save();
            DB::commit();

            $this->logAction(
                action: 'create',
                objId: $model->id,
                objTable: 'settings',
                description: "Yeni ayarlar yaradıldı"
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
            $model = Setting::findOrFail($id);
            $old   = $model->toArray();

            if (!empty($data['header_logo']) && $data['header_logo']->isValid()) {
                if ($model['logo']['header_logo'] && Storage::disk('public')->exists($model['logo']['header_logo'])) {
                    Storage::disk('public')->delete($model['logo']['header_logo']);
                }

                $headerLogoName = time() . '_' . $data['header_logo']->getClientOriginalName();
                $headerLogoPath = $data['header_logo']->storeAs('settings', $headerLogoName, 'public');
            }
            if (!empty($data['footer_logo']) && $data['footer_logo']->isValid()) {
                if ($model['logo']['footer_logo'] && Storage::disk('public')->exists($model['logo']['footer_logo'])) {
                    Storage::disk('public')->delete($model['logo']['footer_logo']);
                }
                $footerLogoName = time() . '_' . $data['footer_logo']->getClientOriginalName();
                $footerLogoPath = $data['footer_logo']->storeAs('settings', $footerLogoName, 'public');
            }
            if (!empty($data['favicon']) && $data['favicon']->isValid()) {
                if ($model['logo']['favicon'] && Storage::disk('public')->exists($model['logo']['favicon'])) {
                    Storage::disk('public')->delete($model['logo']['favicon']);
                }
                $faviconLogoName = time() . '_' . $data['favicon']->getClientOriginalName();
                $faviconLogoPath = $data['favicon']->storeAs('settings', $faviconLogoName, 'public');
            }

            $logo = [
                'header_logo' => $headerLogoPath ?? $old['logo']['header_logo'],
                'footer_logo' => $footerLogoPath ?? $old['logo']['footer_logo'],
                'favicon' => $faviconLogoPath ?? $old['logo']['favicon'],
            ];

            $contact = [
                'facebook' => $data['facebook'],
                'instagram' => $data['facebook'],
                'telegram' => $data['telegram'],
                'linkedin' => $data['linkedin'],
            ];

            /* ================= TRANSLATIONS ================= */
            $title = []; $text = [];
            $languages = Language::where('status', 1)->get();

            foreach ($languages as $lang) {
                $code = $lang->code;
                $title[$code] = $data['title'][$code];
                $text[$code] = $data['text'][$code];
            }

            $model->title = $title;
            $model->text  = $text;
            $model->logo = $logo;
            $model->contact = $contact;
            $model->save();

            DB::commit();
            $this->logAction(
                action: 'update',
                objId: $model->id,
                objTable: 'settings',
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
}
