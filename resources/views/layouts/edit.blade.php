@extends('layouts.master')
@section('main-content')
   <div class="feed-container">
        <!--begin::App Content-->
        <div class="create-post">
          <!--begin::Container-->
          <div class="create-post-top">
            <h5>Edit Post</h5>
            <!-- Facebook Feed Container -->
            <form method="POST" action="{{ route('posts.update',$post->id) }}" enctype="multipart/form-data">
                     @csrf
                     @method('PUT')
                <!-- Create Post Box -->
                        <div class="post-content" >
                              <input type="text" value="{{ $post->content }}" name="content">
                        </div>
                        @if($post->image)
                            <img src="{{ asset('storage/'.$post->image) }}" alt="Post Image" class="post-image">
                        @endif
                        @if($post->video)
                            <video width="300" controls>
                            <source src="{{ asset('storage/'.$post->video) }}" alt="Post Image" class="post-image">
                            </video>
                        @endif
                        <br><input type="file" name="image" value="{{ $post->image }}">
                        </div>
                        <div class="action-btn">
                            <button type="submit">Update</button>
                        </div>
                </form>
        </div>
@endsection