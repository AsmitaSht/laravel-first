@section('main-content')
    @php
    use App\Models\Blog;
    use App\Models\Post;
        $blog= Blog::with('user')->latest()->first();
        $posts=Post::with('user')->latest()->first();
    @endphp
    <div class="feed-container">
        <!-- Facebook Feed Container -->
            <div class="feed-container">
                <div class="create-post">
                    <div class="create-post-top">
                        <img src={{ asset('storage/'.auth()->user()->image) }} alt="User" class="user-avatar">
                        <a href="{{ route('blogs.create') }}">
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
                @if($blog)
                    <div class="post">
                        <div class="post-header">
                        <img src="{{ asset('storage/'.$blog->user->image) }}" alt="User" class="user-avatar">
                            <div class="post-info">
                                <span><i class="fas fa-globe-americas"></i> {{ $blog->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                            <div class="post-content" >
                                    {{ $blog->content }}
                            </div>
                            @if($blog->image)
                                <img src="{{ asset('storage/'.$blog->image) }}" alt="Post Image" class="post-image">
                            @endif
                            @if($blog->video)
                                <video width="300" controls>
                                <source src="{{ asset('storage/'.$blog->video) }}" alt="Post Image" class="post-image">
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
                                 <i class="far fa-comment-alt"></i>
                                    Comment
                                    </a>
                                </div>
                                <div class="post-action-btn">
                                   <i class="fas fa-share"></i> <a href="#">Share </a>
                                </div>
                            </div>
                                @foreach($blog->comments as $comm)
                                <div class="create-post-top">
                                    <img src={{ asset('storage/'.$comm->user->image) }} alt="User" class="user-avatar">
                                    <div class="post-content" style="text-align: left">
                                        {{ $comm->content }}
                                    </div>
                                </div>
                                @endforeach
                            <div class="create-post-top">
                            <img src={{ asset('storage/'.auth()->user()->image) }} alt="User" class="user-avatar">
                            <form method="POST" action="/cmt" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{ $blog->id }}" name="commentable_id">
                                <input type="hidden" value="{{ get_class($blog) }}" name="commentable_type">
                                <input type="text" placeholder="What's on your mind, {{ auth()->user()->name }}" name="content">
                                <button type="submit">
                                    <i class="fa-solid fa-paper-plane"></i>
                                </button>
                            </form>

                            </div>
                        
                @endif
                @if($posts)
                    <div class="post">
                        <div class="post-header">
                        <img src="{{ asset('storage/'.$posts->user->image) }}" alt="User" class="user-avatar">
                            <div class="post-info">
                                <span><i class="fas fa-globe-americas"></i> {{ $posts->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                            <div class="post-content" >
                                    {{ $posts->content }}
                            </div>
                            @if($posts->image)
                                <img src="{{ asset('storage/'.$posts->image) }}" alt="Post Image" class="post-image">
                            @endif
                            @if($posts->video)
                                <video width="300" controls>
                                <source src="{{ asset('storage/'.$posts->video) }}" alt="Post Image" class="post-image">
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
                                 <i class="far fa-comment-alt"></i>
                                    Comment
                                    </a>
                                </div>
                                <div class="post-action-btn">
                                   <i class="fas fa-share"></i> <a href="#">Share </a>
                                </div>
                            </div>
                                @foreach($posts->comments as $comm)
                                <div class="create-post-top">
                                    <img src={{ asset('storage/'.$comm->user->image) }} alt="User" class="user-avatar">
                                    <div class="post-content" style="text-align: left">
                                        {{ $comm->content }}
                                    </div>
                                </div>
                                @endforeach
                            <div class="create-post-top">
                            <img src={{ asset('storage/'.auth()->user()->image) }} alt="User" class="user-avatar">
                            <form method="POST" action="/cmt" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{ $posts->id }}" name="commentable_id">
                                <input type="hidden" value="{{ get_class($posts) }}" name="commentable_type">
                                <input type="text" placeholder="What's on your mind, {{ auth()->user()->name }}" name="content">
                                <button type="submit">
                                    <i class="fa-solid fa-paper-plane"></i>
                                </button>
                            </form>

                            </div>
                        
                @endif
            </div>
    </div>
@endsection
