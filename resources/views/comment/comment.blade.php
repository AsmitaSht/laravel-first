<script>
window.commentConfig = {
    csrf: "{{ csrf_token() }}",
    username: "{{ Auth::user()->name }}",
    route: "{{ route('cmt.store') }}"
};
</script>
<script src="{{ asset('js/comment.js') }}"></script>
@foreach ($comments as $comm)
 <div class="create-post-top">
    <img src={{ asset('storage/'.$comm->user->image) }} alt="User" class="user-avatar">
    <div class="post-content" style="text-align: left">
    <div style="margin-left: {{ $level }}px;">
          <p>{{ $comm->content }}</p>
        <button type="button" onclick="cmtreply({{$comm->id}},'{{ $model->id }}', '{{ addslashes(get_class($model)) }}')">Reply</button>
        <p id="reply-{{ $comm->id }}">
        @if($comm->replies->count())
        <a href="#" onclick="reply()">View {{$comm->replies->count()}} replies</a></p>
        <script>
            function reply(){
                         }
        </script>
        @endif
        {{-- @if ($comm->replies->count())
            @include('comment.comment', [
                'comments' => $comm->replies,/*replies function call*/
                'level' => $level + 20
                ])
             @endif --}}
    </div>
    </div>
 </div>
@endforeach
