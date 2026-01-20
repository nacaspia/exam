<?php

namespace App\Providers;

use App\Http\Interfaces\ICmsUserService;
use App\Http\Interfaces\IExamService;
use App\Http\Interfaces\ILanguageService;
use App\Http\Interfaces\IQuestionService;
use App\Http\Interfaces\IRoleService;
use App\Http\Interfaces\ISchoolClassService;
use App\Http\Interfaces\ISettingService;
use App\Http\Interfaces\ISubjectService;
use App\Http\Interfaces\IUserService;
use App\Http\Services\CmsUserService;
use App\Http\Services\ExamService;
use App\Http\Services\LanguageService;
use App\Http\Services\QuestionService;
use App\Http\Services\RoleService;
use App\Http\Services\SchoolClassService;
use App\Http\Services\SettingService;
use App\Http\Services\SubjectService;
use App\Http\Services\UserService;
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
        $this->app->bind(ISchoolClassService::class, SchoolClassService::class);
        $this->app->bind(ISubjectService::class, SubjectService::class);
        $this->app->bind(IQuestionService::class, QuestionService::class);
        $this->app->bind(ISettingService::class, SettingService::class);
        $this->app->bind(IExamService::class, ExamService::class);
        $this->app->bind(IUserService::class, UserService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }
}
