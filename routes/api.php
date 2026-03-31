<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BlogController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\MailController;
use App\Models\Post;

// Route::post('/send-mail', [MailController::class, 'send']);


Route::post('signup',[AuthController::class,'signup']);
Route::post('login',[AuthController::class,'login']);


Route::middleware('auth:sanctum')->group(function()
{
    Route::post('logout',[AuthController::class,'logout']);
    Route::apiResource('posts',PostController::class);
    Route::apiResource('blogs',BlogController::class);
});
