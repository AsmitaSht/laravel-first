@extends('layouts.master')
@section('main-content')
    <div class="feed-container">
        <!--begin::App Content-->
        <div class="create-post">
          <!--begin::Container-->
          <div class="create-post-top">
            <!-- Facebook Feed Container -->
            <div class="feed-container">
                <form method="POST" action="{{ str_replace('/create', '', url()->current()) }}" enctype="multipart/form-data">
                @csrf
                <!-- Create Post Box -->
                <div class="create-post">
                    <div class="create-post-top">
                        <h5>Create Post</h5>
                        <input type="text" placeholder="What's on your mind, {{ auth()->user()->name }}" name="content">
                    </div>
                        <div class="create-post-bottom">
                            <label for="photo-video-input" class="action-btn">
                                 <i class="fas fa-images video-icon"></i>Photo
                            </label>
                            <input type="file" id="photo-video-input" style="display: none;" name="image">
                        </div>
                        <div class="action-btn">
                            <label for="live-video-input" class="action-btn">
                                <i class="fas fa-video photo-icon"></i> Video
                            </label>
                            <input type="file" id="live-video-input" style="display: none;" name="video">
                        </div>
                        <div class="action-btn">
                            <button type="submit" class="action-btn">Post</button>
                        </div>
                </div>
                </form>
        </div>
@endsection