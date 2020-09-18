@extends('layouts.bloglayout')
@section('title','Post')
@section('heading',$blog->title)
@section('meta', 'Posted by ' . $blog->user->name . " on " . date('M j, Y', strtotime($blog->created_at)))
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="container">
        <article>

            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">

                    {!! $blog->body !!}

                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <h5 class="">Leave a Comment :</h5>

                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif

                    <form method="post" action="{{ route('comment.store', $blog->id)}}">
                        @csrf

                        @if(Auth::check())
                            <input type="hidden" name="creator" value="{{Auth::user()->name}}">
                        @endif

                        <input type="hidden" name="post_id" value="{{$blog->id}}">
                        <textarea name="body" class="form-control"
                                  rows="3">{{old('body')}}</textarea>
                        <br>
                        <button type="submit" class="btn btn-info btn-primary">Submit</button>
                    </form>
                </div>
            </div>

            <hr/>

            <div class="row">
                <div id="comments" class="col-lg-8 col-md-10 mx-auto">
                    @foreach($blog->comments as $comment)
                        <div id="comment {{$comment->id}}" class="media mb-4">
                            <div class="media-body">
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
                                     class="rounded-circle fa-pull-left mr-4">
                                {{ $comment->body }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </article>
    </div>
@endsection
