@extends('layouts.bloglayout')
@section('title','Post')
@section('heading',$blog->title)
@section('meta', 'Posted by ' . $blog->user->name . " on " . date('M j, Y', strtotime($blog->created_at)))
@section('content')

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

                    @include('layouts.error')

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
                <div id="comments" class="col-lg-8 col-md-10 mx-auto rounded" style="background-color: rgba(203, 209, 208, 0.25)">
                    @include('partials._comment_replies', ['comments' => $blog->comments, 'post_id' => $blog->id])
                </div>
            </div>

        </article>
    </div>
@endsection
