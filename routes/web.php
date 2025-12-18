<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RolesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QrController;
use App\Http\Controllers\CmsUsersController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\SubjectController;

use App\Http\Controllers\Web\SiteController;
use App\Http\Controllers\Web\User\AccountController;

Route::prefix('{locale?}')->middleware('set.locale')->group(function () {
    Route::get('/', [SiteController::class, 'index'])->name('site.index');
    Route::get('/exams', [SiteController::class, 'exams'])->name('site.exams');
    Route::get('/subjects', [SiteController::class, 'subjects'])->name('site.subjects');
    Route::get('/classes', [SiteController::class, 'classes'])->name('site.classes');
    Route::get('/achievements', [SiteController::class, 'achievements'])->name('site.achievements');
    Route::get('/blogs', [SiteController::class, 'blogs'])->name('site.blogs');
    Route::get('/about-us', [SiteController::class, 'about'])->name('site.about');
    Route::get('/faqs', [SiteController::class, 'faqs'])->name('site.faqs');
    Route::get('/contact', [SiteController::class, 'contact'])->name('site.contact');
    Route::get('/terms-conditions', [SiteController::class, 'termsConditions'])->name('site.terms-conditions');
    Route::get('/privacy-policy', [SiteController::class, 'privacyPolicy'])->name('site.privacy-policy');

    Route::get('/login', [\App\Http\Controllers\Web\AuthController::class, 'login'])->name('site.auth.login');
    Route::get('/register', [\App\Http\Controllers\Web\AuthController::class, 'register'])->name('site.auth.register');
    Route::get('/forgot-password', [\App\Http\Controllers\Web\AuthController::class, 'forgotPassword'])->name('site.auth.forgot-password');
    Route::get('/reset-password', [\App\Http\Controllers\Web\AuthController::class, 'resetPassword'])->name('site.auth.reset-password');

    Route::get('/user/account', [AccountController::class, 'account'])->name('site.user.account');
});

Route::prefix('/admin')->middleware('check.ip')->group( function () {
    Route::get('/qr-login', [QrController::class, 'showLoginQr'])->name('qr.showLoginQr');
    Route::get('/qr-verify', [QrController::class, 'qrVerifyForm'])->name('qr.verify');
    Route::post('/qr-check', [QrController::class, 'qrCheck'])->name('qr.check');

    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::post('/auth', [AuthController::class,'auth'])->name('auth');
    Route::get('/logout', [AuthController::class,'logout'])->name('logout');

    Route::group(['middleware' => 'auth:cms'], function () {
        Route::get('/home', [HomeController::class, 'home'])->name('home');
        Route::resource('roles',RolesController::class);
        Route::resource('cms-users',CmsUsersController::class);
        Route::resource('languages',LanguageController::class);
        Route::resource('school-classes',SchoolClassController::class);
        Route::resource('subjects',SubjectController::class);
    });
});

