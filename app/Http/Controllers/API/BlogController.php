<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use phpDocumentor\Reflection\Types\String_;

class BlogController extends BaseController
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $data['blogs']=Blog::all();
        return $this->sendResponse($data,"successful");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate=Validator::make(
            $request->all(),[
                'content'=>'required',
                'image'=>'nullable||image:jpg,png,jpeg,gif,svg|max:2048',
                'video'=>'nullable||mimes:mp4,mpv,avi|max:20000'
            ]);

        if($validate->fails()){
            return $this->sendError('error',$validate->errors()->all());
        }
        $imagePath=null;
        $videoPath=null;
        if($request->hasFile('image')){
            $imagePath=$request->file('image')->store('blogs','public');
        }
        if($request->hasFile('video')){
            $videoPath=$request->file('video')->store('blogs','public');
        }
        $this->authorize('create',Blog::class);
        $blog=Blog::create([
            'user_id'=>Auth::id(),
            'content'=>$request->content,
            'image'=>$imagePath,
            'video'=>$videoPath
            ]);
        
            return $this->sendResponse($blog,"successful");

    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
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
             $imagePath = $request->file('image')->store('blogs', 'public');
            }

            if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('blogs', 'public');
            }
            
            $this->authorize('update',Blog::find($id));
            // $blog=Blog::where('id', $id)->update([
            $blog=Blog::ById($id)->update([
            'content'=>$request->content,
            'image'=>$imagePath,
            'video'=>$videoPath
            ]);
            return $this->sendResponse($blog,'Successful');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {   
        $this->authorize('delete',$id);
        // $blog=Blog::where('id',$id)->firstOrFail();
        $blog=Blog::ById($id)->firstOrFail();
        $imagePath=$blog->image;
        $videoPath=$blog->video;
        $filePath=public_path('storage/'.$imagePath);
        unlink($filePath);
        $videoFilePath=public_path('storage/'.$videoPath);
        unlink($videoFilePath);
        $blog->delete();
        return $this->sendResponse($blog,'Successful');
    }
}
