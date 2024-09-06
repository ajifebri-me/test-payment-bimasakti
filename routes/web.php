<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
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

Route::middleware('guest')->group(function(){
    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::post('/process-login', [AuthController::class, 'processLogin'])->name('process_login');
});

Route::middleware('auth')->group(function(){
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('dashboard',[DashboardController::class,"index"])->name("dashboard");
    Route::put('/update-status/{id}', [DashboardController::class, 'updateStatus'])->name('update.status');
});

