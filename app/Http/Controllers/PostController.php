<?php

namespace App\Http\Controllers;
use App\Models\Post;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { 
        return view('home.index3');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {return view('layouts.postlay');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $request->validate([
        'content' => 'required',
        'image' => 'nullable|image',
        'video' => 'nullable|mimes:mp4,mov,avi|max:20000'
    ]);

    $imagePath = null;
    $videoPath = null;

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('posts', 'public');
    }

    if ($request->hasFile('video')) {
        $videoPath = $request->file('video')->store('posts', 'public');
    }

    Post::create([
        'user_id' => Auth::id(),
        'content' => $request->content,
        'image' => $imagePath,
        'video' => $videoPath
    ]);

    return redirect('/home');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('layouts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {  
         $imagePath = $post->image;
        $videoPath = null; 
        if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('posts', 'public');
            }

            if ($request->hasFile('video')) {
                $videoPath = $request->file('video')->store('posts', 'public');
            }
        $post-> update([
        'content'=>$request->content,
        'image'=>$imagePath
        ]);

        return redirect('/profile')->with('success','Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
     $post->delete();
     return redirect('/profile')->with('success', 'Post deleted!');   
    }
}
