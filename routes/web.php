<?php
use App\Models\Blog;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\auth\loginController;
use App\Http\Controllers\auth\RegisterController;

Route::get('/', [BlogController::class,'index']);

Route::get('/home',function()
{
    return view('home.index');
});

Route::view('/register','auth.register')
->middleware('guest')
->name('register');

Route::view('/login','auth.login')
->middleware('guest')
->name('login');

Route::post('/login',loginController::class)
->middleware('guest');

Route::post('/register', RegisterController::class)
->middleware('guest');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/')->with('success', 'Logged out successfully!');
})->middleware('auth')->name('logout');

Route::get('/profile',[profileController::class,'index']);

Route::resource('posts',BlogController::class);

Route::resource('users',UserController::class);