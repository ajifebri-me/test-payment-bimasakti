<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post("register",[AuthController::class,"register"]);
Route::post("login",[AuthController::class,"login"]);

Route::middleware('auth.sectoken')->group(function(){
    Route::get("order",[TransactionController::class,"order"]);
    Route::get("payment",[TransactionController::class,"payment"]);
    Route::get("status",[TransactionController::class,"status"]);
});
