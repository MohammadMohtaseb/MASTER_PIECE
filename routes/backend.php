<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\ClassRoomController;
use App\Http\Controllers\admin\MaterialController;
use App\Http\Controllers\admin\ParentController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\admin\StageController;
use App\Http\Controllers\admin\StudentController;
use App\Http\Controllers\Admin\TeacherControlller;
use Illuminate\Support\Facades\Route;


// Admin routes with auth middleware
Route::group(['middleware' => 'auth:admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get("/", function () {
        return view("admin.index");
    })->name('home');

    // Materials 
    Route::resource("materials", MaterialController::class);

    // Stages
    Route::resource('stages', StageController::class);

    // Classes
    Route::resource('classes', ClassController::class);

    // ClassRooms 
    Route::get('/get-classes/{stage_id}', [ClassroomController::class, 'getClasses'])->name('get.classes');
    Route::get('/get-classroom/{class}', [ClassroomController::class, 'getClassroom'])->name('get.classroom');

    // Classrooms
    Route::resource('classrooms', ClassRoomController::class);

    // Teachers
    Route::resource('teachers', TeacherControlller::class);

    // Parents
    Route::resource('parents', ParentController::class);

    // Students
    Route::resource('students', StudentController::class);
    

    // Settings

    Route::group(['prefix'=>'settings','as'=>'settings.'],function(){
        Route::get("/",[SettingController::class,'formSetting'])->name('form.setting');
        Route::post("/setting/update",[SettingController::class,'formSettingSubmit'])->name('form.setting.submit');
    });
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

// Admin login route without auth middleware
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login');
});
