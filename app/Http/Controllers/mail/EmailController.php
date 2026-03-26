<?php

namespace App\Http\Controllers\mail;

use App\Http\Controllers\Controller;
use App\Mail\welcomemail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendEmail(){
       $toEmail="asmisht01@gmail.com";
       $message="Hello, Welcome to our website";
       $subject="Welcome to B-Blog";
       
       $request=Mail::to($toEmail)->send(new welcomemail($message,$subject)); 
        dd($request);
    
    }
}
