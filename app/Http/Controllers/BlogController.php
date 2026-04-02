<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Repositories\Interface\BlogRepositoryInterface;

class BlogController extends Controller
{
    public $blogRepository;
    public function __construct(BlogRepositoryInterface $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }
    
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
    $data=$request->validate([
        'content' => 'required',
        'image' => 'nullable|image',
        'video' => 'nullable|mimes:mp4,mov,avi|max:20000'
    ]);

    $imagePath = null;
    $videoPath = null;

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('posts', 'public');
        $data['image']=$imagePath;
    }

    if ($request->hasFile('video')) {
        $videoPath = $request->file('video')->store('posts', 'public');
        $data['video']=$videoPath;
    }
    $data['user_id']=Auth::id();
    $this->blogRepository->store($data);

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
        return view('layouts.edit',['item'=>$blog]);
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
                $data['image']=$imagePath;
            }

            if ($request->hasFile('video')) {
                $videoPath = $request->file('video')->store('posts', 'public');
                $data['video']=$videoPath;
            }
            $this->blogRepository->update($blog,$data);

        return redirect('/profile')->with('success','Blog Updated');

        //$blog->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        Gate::authorize('delete',$blog);
        // $post=Blog::where('id',$blog->id)->firstOrFail();

        // if($post->user_id !== Auth::id()){
        //     abort(403);
        // }

        $imagePath=$blog->image;
        $videoPath=$blog->video;
        $filePath=public_path('storage/'.$imagePath);
        unlink($filePath);
        $this->blogRepository->delete($blog);
        return redirect('/profile')->with('success', 'Post deleted!');   
    }
}
