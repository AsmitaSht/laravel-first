<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PostController extends BaseController
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['posts']=Post::all();
        return $this->sendResponse($data,'All Posts');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateUser=Validator::make(
                $request->all(),[
                'content'=>'required',
                'image' => 'nullable|image',
                'video' => 'nullable|mimes:mp4,mov,avi|max:20000'
                ]);

                if($validateUser->fails())
                    {
                    return $this->sendError('error',$validateUser->errors()->all());
                    }

        $imagePath = null;
        $videoPath = null;

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('posts', 'public');
    }

    if ($request->hasFile('video')) {
        $videoPath = $request->file('video')->store('posts', 'public');
    }

        $this->authorize('create',Post::class);
        $data=Post::create([
        'user_id' => Auth::id(),
        'content' => $request->content,
        'image' => $imagePath,
        'video' => $videoPath
    ]);
        return $this->sendResponse($data,'Successful');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateUser=Validator::make(
                $request->all(),[
                'content'=>'required',
                'image' => 'nullable|image',
                'video' => 'nullable|mimes:mp4,mov,avi|max:20000'
                ]);

                if($validateUser->fails())
                    {
                    return $this->sendError('error',$validateUser->errors()->all());
                    }

            $imagePath = null;
             $videoPath = null;

            if ($request->hasFile('image')) {
             $imagePath = $request->file('image')->store('posts', 'public');
            }

            if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('posts', 'public');
            }

            $this->authorize('update',Post::class);
            // $post=Post::where('id', $id)->update([
            $post=Post::ById($id)->update([
            'content'=>$request->content,
            'image'=>$imagePath,
            'video'=>$videoPath
            ]);
            return $this->sendResponse($post,'Successful');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {   
        $this->authorize('delete',Post::class);
        // $post=Post::where('id',$id)->firstOrFail();
        $post=Post::ById($id)->firstOrFail();
        $imagePath=$post->image;
        $videoPath=$post->video;
        $filePath=public_path('storage/'.$imagePath);
        unlink($filePath);
        $videoFilePath=public_path('storage/'.$videoPath);
        unlink($videoFilePath);
        $post->delete();
        return $this->sendResponse($post,'Successful');
 
    }
}
