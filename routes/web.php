<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\TestController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

    
Route::view("/","frontend.index");
Route::post("/login",[HomeController::class,'login'])->name("frontend.login");