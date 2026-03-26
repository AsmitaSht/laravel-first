<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Mail\welcomemail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;   
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function __invoke(Request $request)
    {   
        // Validate the input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create the user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);
        //mail sending
        $subject="Welcome";
        $message=$validated['name'];
        $req=Mail::to($validated['email'])->send(new welcomemail($message,$subject));   
        // Log them in
        Auth::login($user);



        // Redirect to home
        return redirect('/home')->with('success', 'Welcome to B-Blog!');
    }

}