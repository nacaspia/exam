<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Foundation\Auth\EmailVerificationRequest;

use App\Http\Controllers\RolesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QrController;
use App\Http\Controllers\CmsUsersController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ExamController;
use \App\Http\Controllers\UserController;

use App\Http\Controllers\Web\SiteController;
use App\Http\Controllers\Web\User\AccountController;
use App\Http\Controllers\Web\User\ExamController as UserExamController;

Route::prefix('/admin')->middleware('check.ip')->group( function () {
    Route::get('/qr-login', [QrController::class, 'showLoginQr'])->name('qr.showLoginQr');
    Route::get('/qr-verify', [QrController::class, 'qrVerifyForm'])->name('qr.verify');
    Route::post('/qr-check', [QrController::class, 'qrCheck'])->name('qr.check');

    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::post('/auth', [AuthController::class,'auth'])->name('auth');
    Route::get('/logout', [AuthController::class,'logout'])->name('logout');

    Route::group(['middleware' => ['auth:cms', 'ensure.guard:cms']], function () {
        Route::get('/home', [HomeController::class, 'home'])->name('home');
        Route::resource('roles',RolesController::class);
        Route::resource('cms-users',CmsUsersController::class);
        Route::resource('languages',LanguageController::class);
        Route::resource('school-classes',SchoolClassController::class);
        Route::resource('subjects',SubjectController::class);
        Route::resource('questions',QuestionController::class);
        Route::resource('exams',ExamController::class);
        Route::resource('settings',SettingController::class);
        Route::resource('users',UserController::class);
    });
});

Route::prefix('{locale?}')->middleware(['set.locale'])->group(function () {


    Route::get('/', [SiteController::class, 'index'])->name('site.index');
    Route::get('/search', [SiteController::class, 'search'])->name('site.search');
    Route::get('/exams', [SiteController::class, 'exams'])->name('site.exams');
    //Route::get('/exam-details/{slug}-{id}', [SiteController::class, 'examDetails'])->name('site.examDetails');
    Route::get('/subjects', [SiteController::class, 'subjects'])->name('site.subjects');
    Route::get('/classes', [SiteController::class, 'classes'])->name('site.classes');
    Route::get('/contact', [SiteController::class, 'contact'])->name('site.contact');
    /*Route::get('/achievements', [SiteController::class, 'achievements'])->name('site.achievements');
    Route::get('/blogs', [SiteController::class, 'blogs'])->name('site.blogs');*/
    Route::get('/about-us', [SiteController::class, 'about'])->name('site.about');
    Route::get('/contact', [SiteController::class, 'contact'])->name('site.contact');
    Route::get('/privacy-policy', [SiteController::class, 'privacyPolicy'])->name('site.privacy-policy');
    /*Route::get('/faqs', [SiteController::class, 'faqs'])->name('site.faqs');
    Route::get('/terms-conditions', [SiteController::class, 'termsConditions'])->name('site.terms-conditions');*/

    Route::get('/login', [\App\Http\Controllers\Web\AuthController::class, 'login'])->name('site.auth.login');
    Route::post('/login-accept', [\App\Http\Controllers\Web\AuthController::class, 'loginAccept'])->name('site.auth.login-accept');
    Route::get('/register', [\App\Http\Controllers\Web\AuthController::class, 'register'])->name('site.auth.register');
    Route::post('/register-accept', [\App\Http\Controllers\Web\AuthController::class, 'registerAccept'])->name('site.auth.register-accept');
    Route::get('/verify-email', [\App\Http\Controllers\Web\AuthController::class, 'verifyEmail'])->name('site.verify.email');
    Route::get('/forgot-password', [\App\Http\Controllers\Web\AuthController::class, 'forgotPassword'])->name('site.auth.forgot-password');
    Route::get('/reset-password', [\App\Http\Controllers\Web\AuthController::class, 'showResetForm'])->name('site.password.reset');
    Route::post('/reset-password', [\App\Http\Controllers\Web\AuthController::class, 'resetPassword'])->name('site.password.update');
    Route::post('/forgot-password-accept', [\App\Http\Controllers\Web\AuthController::class, 'forgotPasswordAccept'])->name('site.password.forgotPasswordAccept');
    Route::group(['middleware' => ['userauth:user', 'ensure.guard:user']], function () {
        Route::get('/user/logout', [\App\Http\Controllers\Web\AuthController::class, 'logout'])->name('site.user.logout');
        Route::get('/user/account', [AccountController::class, 'account'])->name('site.user.account');
        Route::get('/user/settings', [AccountController::class, 'settings'])->name('site.user.settings');
        Route::put('/user/settings-update', [AccountController::class, 'settingsUpdate'])->name('site.user.settingsUpdate');
        Route::get('/user/children-add', [\App\Http\Controllers\Web\User\ChildrenController::class, 'create'])->name('site.user.children.create');
        Route::post('/user/children-save', [\App\Http\Controllers\Web\User\ChildrenController::class, 'store'])->name('site.user.children.save');
        Route::get('/user/children-edit/{id}', [\App\Http\Controllers\Web\User\ChildrenController::class, 'edit'])->name('site.user.children.edit');
        Route::put('/user/children-update/{id}', [\App\Http\Controllers\Web\User\ChildrenController::class, 'update'])->name('site.user.children.update');
        Route::delete('/user/children-delete/{id}', [\App\Http\Controllers\Web\User\ChildrenController::class, 'destroy'])->name('site.user.children.delete');

        Route::get('/user/exam/{exam}', [UserExamController::class, 'examShow'])->name('site.user.exams.show');
        Route::get('/user/exam/{exam}/start', [UserExamController::class, 'examStart'])->name('site.user.exams.start');
        Route::post('/user/exam/{exam}/pay', [UserExamController::class, 'examPay'])->name('site.user.exam.pay');
        Route::get('/user/exam/{exam}/solve', [UserExamController::class, 'examSolve'])->name('site.user.exam.solve');
        Route::post('/user/exam/{exam}/finish', [UserExamController::class, 'examFinish'])->name('site.user.exam.finish');
        Route::get('/user/exam/{exam}/result', [UserExamController::class, 'examResult'])->name('site.user.exam.result');
    });
});


Route::group(['middleware' => ['userauth:user', 'ensure.guard:user']], function () {
    // e-point redirect nəticələri
    Route::get('/user/payment/epoint/success',[UserExamController::class, 'epointSuccess'])->name('site.user.epoint.success');
    Route::get('/user/payment/epoint/fail',[UserExamController::class, 'epointFail'])->name('site.user.epoint.fail');
    // e-point callback (server → server)
    Route::post('/user/payment/epoint/callback',[UserExamController::class, 'epointCallback'])->name('site.user.epoint.callback');
});

