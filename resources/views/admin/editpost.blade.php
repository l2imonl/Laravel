@extends('layouts.bloglayout')
@section('title','Edit Post')
@section('heading',$blog->title)
@section('meta', 'Posted by ' . $blog->user->name . " on " . date('M j, Y', strtotime($blog->created_at)))
@section('content')

    @include('layouts/error')

    <div class="container">
        <div class="col-lg-8 col-md-10 mx-auto">
            <form method="post" action="{{ route('post.update', $blog->id) }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group text-center">
                    <label for="image"></label>
                    <input id="image" type="file" name="image" value="{{$blog->heading_image}}" onchange="loadFile(event)">
                </div>

                <div class="form-group">
                    <label>Title</label>
                    <input id="title" type="title" name="title" class="form-control" value="{{ $blog->title }}" onkeyUp="document.getElementById('masthead-h1').innerHTML = this.value"/>
                </div>
                <div class="form-group">
                    <label>Body</label>
                    <textarea id="summary-ckeditor" name="body" class="form-control">{{ $blog->body }}</textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-lg btn-primary btn-block btn-info" type="submit">Edit</button>
                </div>
                <div class="form-group">
                    <a href="{{ URL::previous() }}">Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection
