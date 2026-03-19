@section('main-content')

    @php
     $post= auth()->user()->posts()->latest()->first();  
    @endphp
    <div class="feed-container">
        <!-- Facebook Feed Container -->
            <div class="feed-container">
                <div class="create-post">
                    <div class="create-post-top">
                        <img src={{ asset('storage/'.auth()->user()->image) }} alt="User" class="user-avatar">
                        <a href="{{ route('pst.create') }}">
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
            @if($post)
                <div class="post">
                    <div class="post-header">
                        <img src="{{ asset('storage/'.auth()->user()->image) }}" alt="User" class="user-avatar">
                            <div class="post-info">
                                <span><i class="fas fa-globe-americas"></i> {{ $post->created_at->diffForHumans() }}</span>
                            </div>
                            </div>
                            <div class="post-content" >
                                    {{ $post->content }}
                            </div>
                            @if($post->image)
                                <img src="{{ asset('storage/'.$post->image) }}" alt="Post Image" class="post-image">
                            @endif
                            @if($post->video)
                                <video width="300" controls>
                                <source src="{{ asset('storage/'.$post->video) }}" alt="Post Image" class="post-image">
                                </video>
                            @endif
                            </div>
                            <div class="post-stats">
                                <div class="post-stats-left">
                                        <span></span>
                                </div>
                                <div class="post-stats-right">
                                        <span></span>
                                </div>
                                </div>
                                <div class="post-actions">
                                <div class="post-action-btn">
                                  <i class="far fa-thumbs-up"></i><a href=""> Like </a> 
                                </div>
                                <div class="post-action-btn">
                                 <i class="far fa-comment-alt"></i><a href="{{route('cmt.create')}}">
                                    Comment
                                    </a>
                                </div>
                                <div class="post-action-btn">
                                   <i class="fas fa-share"></i> <a href="#">Share </a>
                                </div>
                            </div>
                            @foreach($post->comments as $comm)
                                <div class="create-post-top">
                                <img src={{ asset('storage/'.auth()->user()->image) }} alt="User" class="user-avatar">
                                <div class="post-content" style="text-align: left">
                                    {{ $comm->content }}<br>
                                    <form method="POST" action="/cmt" enctype="multipart/form-data">
                                        @csrf
                                        <inout type="hidden" value="{{ $comm->id }}" name="post_id">
                                        <button type="submit">Reply</button>
                                    </form>
                                </div>
                                </div>
                            @endforeach
                        </div>
                @endif

    <!-- Facebook Feed Container -->
    
                <!-- Post 1 -->
    <div class="feed-conatiner">
        <div class="post">
            <div class="post-header">
                <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&auto=format&fit=crop&w=100&q=80" alt="User" class="user-avatar">
                <div class="post-info">
                    <h3>Sarah Smith</h3>
                    <span><i class="fas fa-globe-americas"></i> 2 hours ago</span>
                </div>
                <i class="fas fa-ellipsis-h" style="color: #65676b; cursor: pointer;"></i>
            </div>
            <div class="post-content">
                Just arrived in Paris! The city lights are absolutely stunning tonight. 🇫🇷✨ #Travel #Paris
            </div>
            <img src="https://images.unsplash.com/photo-1502602898657-3e91760cbb34?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Post Image" class="post-image">
            
            <div class="post-stats">
                <div class="post-stats-left">
                    <span>❤️John Doe and 45 others</span>
                </div>
                <div class="post-stats-right">
                    <span>12 Comments</span>
                </div>
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
        </div>

        <!-- Post 2 -->
        <div class="post">
            <div class="post-header">
                <img src="https://images.unsplash.com/photo-1599566150163-29194dcaad36?ixlib=rb-1.2.1&auto=format&fit=crop&w=100&q=80" alt="User" class="user-avatar">
                <div class="post-info">
                    <h3>Mike Ross</h3>
                    <span><i class="fas fa-user-friends"></i> 5 hours ago</span>
                </div>
                <i class="fas fa-ellipsis-h" style="color: #65676b; cursor: pointer;"></i>
            </div>
            <div class="post-content">
                Working on a new project today. Can't wait to show you guys the results! 💻🚀
            </div>
            
            <div class="post-stats">
                <div class="post-stats-left">
                    <span>👍12 people</span>
                </div>
                <div class="post-stats-right">
                    <span>4 Comments</span>
                </div>
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
        </div>


@endsection