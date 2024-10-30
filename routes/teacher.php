<?php

use App\Http\Controllers\Teacher\AttendanceController;
use App\Http\Controllers\Teacher\Auth\AuthController;
use App\Http\Controllers\Teacher\ExamController;
use App\Http\Controllers\Teacher\FilemangerController;
use App\Http\Controllers\Teacher\HomeController;
use App\Http\Controllers\Teacher\MessageController;
use App\Http\Controllers\Teacher\MyStudentController;
use App\Http\Controllers\Teacher\QuestionController;
use App\Http\Controllers\Teacher\ReportController;
use App\Http\Controllers\Teacher\SettingController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:teacher', 'prefix' => 'teacher', 'as' => 'teacher.'], function () {
    // Route::view("/",'teacher.index')->name('home');
    Route::get("/", [HomeController::class, 'index'])->name("home");
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // Exams
    Route::resource("exams", ExamController::class);

    // Questions
    Route::group(['prefix' => 'questions', 'as' => 'questions.'], function () {
        Route::get("/{id}", [QuestionController::class, 'index'])->name('home')->whereNumber('id');
        Route::get("/create/{id}", [QuestionController::class, 'create'])->name('create')->whereNumber('id');
        Route::post("/store/{id}", [QuestionController::class, 'store'])->name('store')->whereNumber('id');
        Route::delete("/delete/{id}", [QuestionController::class, 'destory'])->name('destory')->whereNumber('id');

        Route::get("/edit/{id}", [QuestionController::class, 'edit'])->name('edit')->whereNumber('id');
        Route::put("/edit/{id}", [QuestionController::class, 'update'])->name('update')->whereNumber('id');
    });

    // Reports
    Route::get('/reports/get-students/{id}', [ReportController::class, 'getStudent'])->name('reports.get.student');
    Route::resource('reports', ReportController::class);

    // Settings
    Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {
        Route::get("/", [SettingController::class, 'formSetting'])->name('form.setting');
        Route::post("/setting/update", [SettingController::class, 'formSettingSubmit'])->name('form.setting.submit');
    });

    // attendances 
    Route::group(['prefix' => 'attendances', 'as' => 'attendances.'], function () {
        Route::get("/", [AttendanceController::class, 'index'])->name('index');
        Route::get("/search", [AttendanceController::class, 'search'])->name('search');
        Route::post("/store", [AttendanceController::class, 'store'])->name('store');
    });

    // Messages 
    Route::group(['prefix' => 'messages', 'as' => 'messages.'], function () {
        Route::get("/{id}", [MessageController::class, 'index'])->name("home");
        Route::post("/send-message/{type}", [MessageController::class, 'store'])->name("store");
    });


    // FileManger

    Route::resource('filemanger', FilemangerController::class);


    // My Students
    Route::get("/my-students",[MyStudentController::class,'index'])->name("my-students.index");


    // result

    Route::get("/result/{id}",[ExamController::class,'result'])->name("result");

});

Route::group(['middleware' => 'guest', 'prefix' => 'teacher', 'as' => 'teacher.'], function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login');
});
