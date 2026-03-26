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
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\mail\EmailController;

Route::get('/', [HomeController::class,'index']);


Route::view('/register','auth.register')
->middleware('guest');

Route::post('/register', RegisterController::class)
->middleware('guest')->name('register');
Route::get('sendemail',[EmailController::class,'sendEmail']);

Route::view('/login','auth.login')
->middleware('guest')
->name('login');

Route::post('/login',loginController::class)
->middleware('guest');

Route::get('/home',[HomeController::class,'index'])->middleware('auth')->name('/home');


Route::post('/logout', function () {
    Auth::logout();
    return redirect('/')->with('success', 'Logged out successfully!');
})->middleware('auth')->name('logout');

Route::get('/profile',[profileController::class,'index']);

Route::resource('blogs',BlogController::class);

Route::resource('pst',PostController::class);

Route::resource('users',UserController::class);

Route::resource('cmt',CommentController::class);