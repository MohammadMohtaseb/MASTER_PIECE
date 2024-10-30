<?php

use App\Http\Controllers\Parent\AttendanceController;
use App\Http\Controllers\Parent\Auth\AuthController;
use App\Http\Controllers\Parent\ExamController;
use App\Http\Controllers\Parent\MessageController;
use App\Http\Controllers\Parent\ReportController;
use App\Http\Controllers\Parent\SettingController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:parent', 'prefix' => 'parent', 'as' => 'parent.'], function () {
    Route::view("/", 'parent.index')->name('home');
    Route::group(['prefix' => 'result', 'as' => 'exams.'], function () {
        Route::get("/", [ExamController::class, 'index'])->name("home");
    });

    // Result
    Route::group(['prefix' => 'result', 'as' => 'result.'], function () {
        Route::get("/{id}", [ExamController::class, 'showResult'])->name("show");
    });

    // Result
    Route::group(['prefix' => 'reports', 'as' => 'reports.'], function () {
        Route::get("/", [ReportController::class, 'index'])->name("home");
        Route::get("/{id}", [ReportController::class, 'show'])->name("show");
    });

    // Messages 
    Route::group(['prefix' => 'messages', 'as' => 'messages.'], function () {
        Route::get("/{id}", [MessageController::class, 'index'])->name("home");
        Route::post("/send-message/{type}", [MessageController::class, 'store'])->name("store");
    });

    // attendances 
    Route::group(['prefix' => 'attendances', 'as' => 'attendances.'], function () {
        Route::get("/", [AttendanceController::class, 'index'])->name("home");
    });

    
    // Settings
    Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {
        Route::get("/", [SettingController::class, 'formSetting'])->name('form.setting');
        Route::post("/setting/update", [SettingController::class, 'formSettingSubmit'])->name('form.setting.submit');
    });


    // Logout
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::group(['middleware' => 'guest', 'prefix' => 'parent', 'as' => 'parent.'], function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login');
});
