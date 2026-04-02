<script>
window.commentConfig = {
    csrf: "{{ csrf_token() }}",
    username: "{{ Auth::user()->name }}",
    route: "{{ route('cmt.store') }}"
};
</script>
<script src="{{ asset('js/comment.js') }}"></script>
 <div class="create-post-top">
    <img src={{ asset('storage/'.$singleComment->user->image) }} alt="User" class="user-avatar">
    <div class="post-content" style="text-align: left">
    <div style="margin-left: {{ $level }}px;">
          <p>{{ $singleComment->content }}</p>
        <button type="button" onclick="cmtreply({{$singleComment->id}},'{{ $model->id }}', '{{ addslashes(get_class($model)) }}')">Reply</button>
        <p id="reply-{{ $singleComment->id }}">
        @if($singleComment->replies->count())
        <a href="#" onclick="reply()">View {{$singleComment->replies->count()}} replies</a></p>
        <script>
            function reply(){
                         }
        </script>
        @endif
        {{-- @if ($singlecomment->replies->count())
            @include('comment.comment', [
                'comments' => $singlecomment->replies,/*replies function call*/
                'level' => $level + 20
                ])
             @endif --}}
    </div>
    </div>
 </div>

