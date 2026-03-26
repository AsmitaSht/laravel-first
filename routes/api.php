<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\MailController;

// Route::post('/send-mail', [MailController::class, 'send']);


Route::post('signup',[AuthController::class,'signup']);
Route::post('login',[AuthController::class,'login']);

Route::post('logout',[AuthController::class,'logout'])->middleware('auth:sanctum');