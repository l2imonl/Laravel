@extends('layouts.bloglayout')
@section('title','Post')
{{--@section('heading',$blog->title)--}}
{{--@section('meta', 'Posted by ' . $blog->user->name . " on " . date('M j, Y', strtotime($blog->created_at)))--}}
@section('content')
    
    <div id="app">
        <single v-bind:post_id="{{$id}}"></single>
    </div>

@endsection
