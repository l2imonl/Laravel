@extends('layouts.bloglayout')
@section('title','Create Post')
@section('content')

    @include('layouts.error')

    <div class="container">
        <div class="col-lg-8 col-md-10 mx-auto">
            <form method="post" action="{{ route('post.create') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">

                <div class="form-group">
                    <label>Header-Image (optional)</label>
                    <label for="image">Choose Image</label>
                    <input id="image" type="file" name="image" onchange="loadFile(event)">
                </div>

                <div class="form-group">
                    <label>Title</label>
                    <input type="title" name="title" class="form-control"
                           onkeyUp="document.getElementById('masthead-h1').innerHTML = this.value" value="{{old('title')}}"/>
                </div>
                <div class="form-group">
                    <label>Body</label>
                    <textarea id="summary-ckeditor" name="body" class="form-control">{{old('body')}}</textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-lg btn-primary btn-block btn-info" type="submit">Post</button>
                </div>
            </form>
        </div>
    </div>

@endsection

