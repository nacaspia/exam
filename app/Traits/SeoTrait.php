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

        $metaTitle = [];
        $metaDesc  = [];
        $metaSlug   = [];
        $metaKey   = [];

        foreach ($languages as $lang) {
            $langCode = isset($lang['code']) ? $lang['code'] : app()->getLocale();
            $metaTitle[$langCode] = $data['meta_title'][$langCode] ?? null;
            $metaSlug[$langCode] = Str::slug(trim($data['meta_title'][$langCode]));
            $metaDesc[$langCode]  = $data['meta_text'][$langCode] ?? null;
            $metaKey[$langCode]   = $data['meta_keywords'][$langCode] ?? null;
        }

        $seoData = [
            'meta_title'       => $metaTitle,
            'meta_slug'       => $metaSlug,
            'meta_text' => $metaDesc,
            'meta_keywords'    => $metaKey,
            'canonical_url'    => $data['canonical_url'] ?? null,
            'index'            => $data['index'] ?? true,
            'follow'           => $data['follow'] ?? true,
            'og_title'         => $data['og_title'] ?? null,
            'og_slug'         => $data['og_slug'] ?? null,
            'og_text'   => $data['og_text'] ?? null,
        ];

        if ($this->seo) {
            $this->seo->update($seoData);
        } else {
            $this->seo()->create($seoData);
        }
    }
}
