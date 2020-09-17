@extends('layouts.bloglayout')
@section('title','Blog')
@section('heading','Blog')
@section('subheading', 'A Blog Themen by Bootstrap')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">

                @include('layouts.error')

                @foreach($blog as $key => $value)
                    <article class="post-preview">
                        <a href="{{ route('blog.show', $value->id) }}">
                            <h2 class="post-title">{{ $value->title }}</h2>
                            <h3 class="post-subtitle">{!! substr($value->body,0,200) !!}</h3>
                        </a>
                        <p class="post-meta">
                            Posted by <strong>{{ $value->user->name }}</strong> on
                            <strong>{{ date('M j, Y', strtotime($value->created_at)) }}</strong>
                        </p>
                    </article>
                    <hr/>
                @endforeach

                <div class="col-12 text-center">
                    {{$blog->links("pagination::bootstrap-4")}}
                </div>
                <br/>
            </div>
        </div>
    </div>

@endsection
