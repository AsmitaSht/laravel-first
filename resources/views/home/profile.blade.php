@extends('layouts.master')

@section('main-content')
            <!-- Facebook Feed Container -->
            <div class="feed-container">
                <div class="profile-card">
                    <img src="{{ asset('storage/'.auth()->user()->image) }}" alt="Profile Picture" class="profile-picture" placeholder="change PP" style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; ">
                    <h2>{{ auth()->user()->name }}</h2>
                </div>
                <div class="feed-container">
        <!-- Facebook Feed Container -->
            <div class="feed-container">
                <div class="create-post">
                    <div class="create-post-top">
                        <img src={{ asset('storage/'.auth()->user()->image) }} alt="User" class="user-avatar">
                        <a href="{{ route('posts.create') }}">
                        <input type="text" placeholder="What's on your mind, {{ auth()->user()->name }}">
                        </a>
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

                <div class="profile-posts">
                    <h3>Your Posts</h3>
                    @foreach (auth()->user()->posts as $post)
                        <div class="post">
                            <div class="post-header">
                                <img src="{{ asset('storage/'.auth()->user()->image) }}" alt="User" class="user-avatar">
                                <div class="post-info">
                                    <span><i class="fas fa-globe-americas"></i> {{ $post->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="post-menu">
                                    <span><i class="bi bi-three-dots menu-icon"></i></span>
                                    <div class="dropdown-menu">
                                       <a class="dropdown-item" href="{{ route('posts.edit',$post->id) }}">Edit</a>
                                       <form action="{{ route('posts.destroy',$post->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item">Delete</button>
                                       </form>
                                    </div> 
                                </div>
                                <i class="fas fa-ellipsis-h" style="color: #65676b; cursor: pointer;"></i>
                            </div>
                            <div class="post-content" style="text-align: left">
                                {{ $post->content }}
                            </div>
                            @if($post->image)
                                <img src="{{ asset('storage/'.$post->image) }}" width="350" style='margin-top: 10px; margin-bottom: 10px;margin-left: auto;margin-right: auto;'>
                            @endif
                            @if($post->video)
                            <video width="300" controls>
                                <source src="{{ asset('storage/'.$post->video) }}">
                            </video>
                            @endif
                            </div>
                            <div class="post-actions">
                            <div class="post-action-btn">
                                <i class="far fa-thumbs-up"></i> Like
                            </div>
                            <div class="post-action-btn">
                                <i class="far fa-comment-alt"></i> Comment
                            </div>
                            <div class="post-action-btn">
                                <i class="fas fa-share"></i> Share
                            </div>
                        </div>
                    @endforeach
                    <script>
                        document.querySelectorAll('.menu-icon').forEach(icon => {
                            icon.addEventListener('click', function () {
                                const dropdown = this.closest('.post-menu').querySelector('.dropdown-menu');
                                dropdown.classList.toggle('show');
                            });
                        });
                    </script>
                </div>
            </div>
@endsection

