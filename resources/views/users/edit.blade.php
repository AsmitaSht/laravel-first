@extends('layouts.master')
@section('main-content')
   <div class="feed-container">
        <!--begin::App Content-->
        <div class="create-post">
          <!--begin::Container-->
          <div class="create-post-top">
            <h5>Edit Post</h5>
            <!-- Facebook Feed Container -->
            <form method="POST" action="{{ route('users.update',auth()->id()) }}" enctype="multipart/form-data">
                     @csrf
                     @method('PUT')
                <!-- Create Post Box -->
                    Name:
                        <div class="post-content" >
                              <input type="text" value="{{ auth()->user()->name }}" name="content">
                        </div>
                        @if(auth()->user()->image)
                            <img src="{{ asset('storage/'.auth()->user()->image) }}" alt="Post Image" class="post-image">
                        @endif
                        <br><input type="file" name="image" value="{{ auth()->user()->image }}">
                        </div>
                        <div class="action-btn">
                            <button type="submit">Update</button>
                        </div>
                </form>
        </div>
@endsection