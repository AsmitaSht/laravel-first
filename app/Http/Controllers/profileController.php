<?php

namespace App\Http\Controllers;
use App\Http\Models\Blog;

use Illuminate\Http\Request;

class profileController extends Controller
{
    public function index()
    {
        return view('home.profile');
    }
}
