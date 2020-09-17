@extends('layouts.master')
@section('title','Post')
@section('content')
    <div class="container">
        <div class="col-lg-8 col-md-10 mx-auto">
            <div class="row">
                <div class="col-md-12">
                    <h1>{{ $blog->title }}</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <p class="post-meta">
                        Posted by <strong>{{ $blog->user->name}}</strong> on
                        <strong>{{ date('M j, Y', strtotime($blog->created_at)) }}</strong>
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <p> {{ $blog->body }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="clearfix"></div>
                    <hr>
                    <ul class="media-list">

                        @foreach($blog->comments as $comment)

                            <strong>{{ $comment->creator}}</strong>

                            <p>{{ $comment->body }}</p>

                            @if(auth()->check() && auth()->user()->hasRole('admin'))
                                <form method="post" action="{{ route('comment.destroy', $comment->id) }}">
                                    @csrf
                                    <button type="submit" class="btn-sm btn-danger"><i class="fa fa-trash"
                                                                                       aria-hidden="true"></i></button>
                                </form>
                            @endif
                            <hr/>
                        @endforeach
                        <br/>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('post.index') }}" class="btn btn-info btn-block">All Posts</a>
                </div>
            </div>
            <br/>
        </div>
    </div>
@endsection
