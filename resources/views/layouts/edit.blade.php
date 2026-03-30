@extends('layouts.master')
@section('main-content')
   <div class="feed-container">
        <!--begin::App Content-->
        <div class="create-post">
          <!--begin::Container-->
          <div class="create-post-top">
            <h5>Edit Post</h5>
           
            <!-- Facebook Feed Container -->
            <form method="POST" action="{{ str_replace('/edit', '', url()->current()) }}" enctype="multipart/form-data">
                        @csrf
                     @method('PUT')
                <!-- Create Post Box -->
                        <div class="post-content" >
                              <input type="text" value="{{ $blog->content }}" name="content">
                        </div>
                        @if($blog->image)
                            <img src="{{ asset('storage/'.$blog->image) }}" alt="Post Image" class="post-image">
                        @endif
                        @if($blog->video)
                            <video width="300" controls>
                            <source src="{{ asset('storage/'.$blog->video) }}" alt="Post Image" class="post-image">
                            </video>
                        @endif
                        <br><input type="file" name="image" value="{{ $blog->image }}">
                        </div>
                        <div class="action-btn">
                            <button type="submit">Update</button>
                        </div>
                </form>
        </div>
@endsection