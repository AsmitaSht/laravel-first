@extends('layouts.master')

@section('main-content')
<div class="feed-container">
    <div class="profile-card">
        <img src="{{ asset('storage/'.auth()->user()->image) }}" alt="Profile Picture" class="profile-picture" placeholder="change PP" style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; ">
        <h2>{{ auth()->user()->name }}</h2>
    </div>
</div>
<!-- Facebook Feed Container -->
<div class="feed-container">
    <div class="create-post">
        <div class="create-post-top">
            <img src={{ asset('storage/'.auth()->user()->image) }} alt="User" class="user-avatar">
            <a href="{{ route('blogs.create') }}">
            <input type="text" placeholder="What's on your mind, {{ auth()->user()->name }}">
        </div>
        <div class="create-post-bottom">
            <div class="action-btn">
                <i class="fas fa-video video-icon"></i> Live Video
            </div>
            <div class="action-btn">
                <i class="fas fa-images photo-icon"></i> Photo/Video
            </div>
            <div class="action-btn">
                <i class="fas fa-smile feeling-icon"></i> Feeling/Activity
            </div>
        </div>
            </a>
    </div>
    <div class="profile-posts">
        <h3>Your Blogs</h3>
            @include('index.blog')
    </div>
    <div class="profile-posts">
        <h3>Your Posts</h3>
        @include('index.post')
    </div>
</div>
        <script>
                        document.querySelectorAll('.menu-icon').forEach(icon => {
                            icon.addEventListener('click', function () {
                                const dropdown = this.closest('.post-menu').querySelector('.dropdown-menu');
                                dropdown.classList.toggle('show');
                            });
                        });
        </script>

@endsection

