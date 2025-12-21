<?php

namespace App\Traits;

use App\Models\Language;
use App\Models\Seo;
use Illuminate\Support\Str;

trait SeoTrait
{
    public function seo()
    {
        return $this->morphOne(Seo::class, 'seoable');
    }

    public function saveSeo(array $data): void
    {
        $languages = Language::where('status', 1)->get();

        $metaTitle = []; $metaDesc  = []; $metaSlug   = []; $metaKey   = [];
        $og_title = []; $og_slug = []; $og_description = [];
        foreach ($languages as $lang) {
            $langCode = isset($lang['code']) ? $lang['code'] : app()->getLocale();
            $metaTitle[$langCode] = $data['meta_title'][$langCode] ?? [];
            $metaSlug[$langCode] = !empty($data['meta_title'][$langCode])? Str::slug(trim($data['meta_title'][$langCode])) : [];
            $metaDesc[$langCode]  = $data['meta_text'][$langCode] ?? [];
            $metaKey[$langCode]   = $data['meta_keywords'][$langCode] ?? [];

            $og_title[$langCode]   = $data['og_title'][$langCode] ?? [];
            $og_slug[$langCode]   = !empty($data['og_title'][$langCode])? Str::slug(trim($data['og_title'][$langCode])) : [];
            $og_description[$langCode]   = $data['og_text'][$langCode] ?? [];
        }

        $seoData = [
            'meta_title'       => $metaTitle,
            'meta_slug'       => $metaSlug,
            'meta_text' => $metaDesc,
            'meta_keywords'    => $metaKey,
            'canonical_url'    => $data['canonical_url'] ?? null,
            'index'            => $data['index'] ?? true,
            'follow'           => $data['follow'] ?? true,
            'og_title'         => $og_title ?? null,
            'og_slug'         => $og_slug ?? null,
            'og_text'   => $og_description ?? null,
        ];

        if ($this->seo) {
            $this->seo->update($seoData);
        } else {
            $this->seo()->create($seoData);
        }
    }
}
