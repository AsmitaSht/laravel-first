<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('home.index4');
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

    Blog::create([
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
    public function show(Blog $blog)
    {
        Gate::authorize('view', $blog);
        return view('home.index4',compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        return view('layouts.edit',compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {   Gate::authorize('update',$blog);
         $imagePath = $blog->image;
        $videoPath  = $blog->video; 
        if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('posts', 'public');
            }

            if ($request->hasFile('video')) {
                $videoPath = $request->file('video')->store('posts', 'public');
            }
        $blog-> update([
        'content'=>$request->content,
        'image'=>$imagePath,
        'video'=>$videoPath
        ]);

        return redirect('/profile')->with('success','Blog Updated');

        //$blog->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        Gate::authorize('delete',$blog);
        $blog->delete();
        return redirect('/profile')->with('success', 'Post deleted!');   
    }
}
