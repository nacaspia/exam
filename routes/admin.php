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
