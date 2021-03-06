@foreach($comments as $comment)
    <div id="comment {{$comment->id}}" class="media">
        <div class="media-body px-2">
            <h5 class="mt-0">{{ $comment->user->name }}</h5>
            @if(auth()->check() && auth()->user()->hasRole('admin'))

                <button id="deleteComment"
                        class="btn-sm btn-danger fa-pull-right deleteComment"
                        data-id="{{ $comment->id }}"><i
                        class="fa fa-trash"
                        aria-hidden="true"></i>
                </button>

            @endif
            <img src="{{$comment->user->profile_photo_url}}"
                 class="profile-photo fa-pull-left mr-4 mb-2">
            {!! $comment->body !!}
            <form method="post" action="{{ route('comment.replyStore', $blog->id)}}">
                @csrf
                <div class="form-group">
                    <input type="text" name="body" class="form-control"/>
                    {{--                <input type="hidden" name="post_id" value="{{ $post_id }}" />--}}
                    <input type="hidden" name="comment_id" value="{{ $comment->id }}"/>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn" value="Reply"/>
                </div>
            </form>
            <div class="mb-4 ml-4 rounded" style="background-color: rgba(223, 229, 232, 1)">
                @include('partials._comment_replies', ['comments' => $comment->replies])
            </div>
        </div>
    </div>
@endforeach
