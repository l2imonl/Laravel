@extends('layouts.master')
@section('title','Create Post')
@section('content')

    @include('layouts/error')
    <div class="container">
        <div class="col-lg-8 col-md-10 mx-auto">
            <form method="post" action="{{ route('post.create') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">

                <div class="form-group">
                    <label>Header-Image (optional)</label>
                    <label for="image">Choose Image</label>
                    <input id="image" type="file" name="image">
                </div>

                <div class="form-group">
                    <label>Title</label>
                    <input type="title" name="title" class="form-control"/>
                </div>
                <div class="form-group">
                    <label>Body</label>
                    <textarea id="body" name="body" rows="5" cols="33" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-lg btn-primary btn-block btn-info" type="submit">Post</button>
                </div>
            </form>
        </div>
    </div>
@endsection

