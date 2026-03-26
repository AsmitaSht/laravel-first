@php
    $post=auth()->user()->posts()->latest()->first();
@endphp
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
                                        <input type="hidden" value="{{ $comm->id }}" name="blog_id">
                                        <button type="submit">Reply</button>
                                    </form>
                                </div>
                                </div>
                            @endforeach
                        </div>
                @endif
    </div>