<?php

use App\Http\Controllers\Student\SettingController;
use App\Http\Controllers\Student\AnswerController;
use App\Http\Controllers\Student\Auth\AuthController;
use App\Http\Controllers\Student\DocumentController;
use App\Http\Controllers\Student\ExamController;
use Illuminate\Support\Facades\Route;



Route::group(['middleware' => 'auth:student', 'prefix' => 'student', 'as' => 'student.'], function () {
    Route::view("/", 'student.index')->name('home');

    // Exams
    Route::group(['prefix' => 'exams', 'as' => 'exams.'], function () {
        Route::get("/", [ExamController::class, 'index'])->name("home");
        Route::get("/enter/{id}", [ExamController::class, 'enter'])->name("enter");
    });


    // Answers
    Route::group(['prefix' => 'answer', 'as' => 'answer.'], function () {
        Route::post("/save-answer", [AnswerController::class, 'saveAnswer'])->name("save");
        Route::get("/get-questions", [AnswerController::class, 'getQuestionsWithAnswers'])->name("questions_with_answers");

        Route::post('/answer/finish', [AnswerController::class, 'finishExam'])->name('exam.finish');
    });

    // Result
    Route::group(['prefix' => 'result', 'as' => 'result.'], function () {
        Route::get("/{id}", [ExamController::class, 'showResult'])->name("show");
    });


    // Settings
    Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {
        Route::get("/", [SettingController::class, 'formSetting'])->name('form.setting');
        Route::post("/setting/update", [SettingController::class, 'formSettingSubmit'])->name('form.setting.submit');
    });


    // Documents
    Route::get("my-documents",[DocumentController::class,'index'])->name('documents');

    // Logout
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});


Route::group(['middleware' => 'guest', 'prefix' => 'student', 'as' => 'student.'], function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login');
});
