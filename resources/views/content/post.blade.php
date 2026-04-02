 @php
    use App\Models\Post;
     $posts= Post::with('user')->latest()->first();
     $latestComment=$posts->comments()->where('parent_id',null)->latest()->first();   
    @endphp

<div class="post">
        <div class="post-header">
            <img src="{{ asset('storage/'.$posts->user->image) }}" alt="User" class="user-avatar">
            <div class="post-info">
                <span><i class="fas fa-globe-americas"></i> {{ $posts->created_at->diffForHumans() }}</span>
            </div>
        </div>
        <div class="post-content">
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

        <div class="post-stats">
            <div class="post-stats-left">
                <span>li</span>
            </div>
            <div class="post-stats-right">
                <span>{{$posts->comments->count()}} Comments</span>
            </div>
        </div>
        <div class="post-actions">
            <div class="post-action-btn">
                <i class="far fa-thumbs-up"></i><a href=""> Like </a> 
            </div>
            <div class="post-action-btn">
                <i class="far fa-comment-alt"></i><a href="">
                    {{-- {{route('cmt.create',$posts->id)}} --}}
                    Comment
                </a>
            </div>
            <div class="post-action-btn">
                <i class="fas fa-share"></i> <a href="#">Share </a>
            </div>
        </div>
        @if($latestComment)
            @include('comment.home', [
                'singleComment' => $latestComment, 
                'level' => 0,
                'model' => $posts
                    ])
        @endif
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
            </div>