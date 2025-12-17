<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Language;
class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->route('locale');

        // URL-də locale varsa
        if ($locale) {
            $exists = cache()->remember(
                "locale_exists_{$locale}",
                3600,
                fn () => Language::where([
                    'code' => $locale,
                    'status' => 1
                ])->exists()
            );

            if (!$exists) {
                abort(404);
            }

            app()->setLocale($locale);
            session(['locale' => $locale]);
        } else {
            // fallback
            $locale = session('locale') ?? cache()->remember(
                'default_locale',
                3600,
                fn () => Language::where('is_default', 1)->value('code')
            );

            app()->setLocale($locale);
        }

        return $next($request);
    }

    /* public function handle(Request $request, Closure $next): Response
     {
         $locale = session('locale');

         if (!$locale) {
             $locale = cache()->remember('default_locale', 3600, function () {
                 return Language::where(['is_default' => true, 'status' => true])->value('code');
             });
         }

         app()->setLocale($locale);
         return $next($request);
     }*/
}
