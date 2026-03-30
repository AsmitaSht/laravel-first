<?php
use App\Models;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\auth\loginController;
use App\Http\Controllers\auth\logoutController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\mail\EmailController;
use App\Http\Middleware\ValidUser;
use App\Http\Middleware\Guest;

Route::get('/', [HomeController::class,'index']);

Route::middleware([Guest::class])->group(function(){
    Route::view('/register','auth.register');
    Route::view('/login','auth.login')->name('login');
    Route::post('/register', RegisterController::class)->name('register');
    Route::post('/login',loginController::class)->name('login');

});


Route::middleware([ValidUser::class])->group((function(){
    Route::get('sendemail',[EmailController::class,'sendEmail']);
    Route::get('/home',[HomeController::class,'index']);
    Route::get('/profile',[profileController::class,'index']);
    Route::resource('blogs',BlogController::class);
    Route::resource('pst',PostController::class);
    Route::resource('users',UserController::class);
    Route::resource('cmt',CommentController::class);
    Route::post('/logout',logoutController::class);

}));




