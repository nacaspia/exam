<?php

namespace App\Providers;

use App\Http\Interfaces\ICmsUserService;
use App\Http\Interfaces\ILanguageService;
use App\Http\Interfaces\IRoleService;
use App\Http\Services\CmsUserService;
use App\Http\Services\LanguageService;
use App\Http\Services\RoleService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IRoleService::class, RoleService::class);
        $this->app->bind(ICmsUserService::class, CmsUserService::class);
        $this->app->bind(ILanguageService::class, LanguageService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
