<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class logoutController extends Controller
{
    public function __invoke()
    {
        Auth::logout();
        return redirect('/login')->with('success','logged out');

    }
}
