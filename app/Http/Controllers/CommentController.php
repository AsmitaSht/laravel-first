<?php

namespace App\Http\Controllers;
use App\Models\Comment;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function create()
    {
        return view('home.index2');
    }

    public function store(Request $request)
    {
            $model = $request->commentable_type::findOrFail($request->commentable_id);

            $model->comments()->create([
                'content' => $request->content,
                'user_id' => Auth::id(),
                'parent_id'=>$request->parent_id,
            ]);
        return back();

    }

   
    
}
