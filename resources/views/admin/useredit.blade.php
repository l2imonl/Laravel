@extends('layouts.master')
@section('title','Post')
@section('content')
    <div class="container">
        <div class="col-lg-8 col-md-10 mx-auto">
            <form method="post" action="{{ route('user.update', $user->id) }}">
                @csrf
                <div class="form-group">
                    <label>Name</label>
                    <input name="name" class="form-control" value="{{ $user->name }}"/>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input name="email" class="form-control" value="{{ $user->email }}">
                </div>
                <div class="form-group">
                    <input type="submit" name="updatepost" class="btn btn-success btn-lg btn-block btn-info"
                           value="Edit"/>
                </div>
                <div class="form-group">
                    <a href="{{ URL::previous() }}">Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection
