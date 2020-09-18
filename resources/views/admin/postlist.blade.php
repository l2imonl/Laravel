@extends('layouts.master')
@section('title','Postlist')
@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container">
        <h1>Post List</h1>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-hover">

                    <thead>
                    <th>#</th>
                    <th>Title</th>
                    <th>Body</th>
                    <th>Posted</th>
                    <th>Autor</th>
                    <th>Comments</th>
                    <th class="text-center" width="130px">
                        @if(auth()->check() && auth()->user()->hasRole('admin'))
                            <a href="createpost" class="btn btn-primary btn-sm btn-info"><i
                                    class="fa fa-plus" aria-hidden="true"></i>
                            </a>
                        @endif
                    </th>
                    </thead>

                    <tbody id="posts">
                    <?php $no = 1; ?>
                    @foreach($blog as $key => $value)

                        <tr id="post {{$value->id}}">
                            <th>{{ $no++ }}</th>
                            <th>{{ $value->title }}</th>
                            <td>{!! substr($value->body,0,40) !!} {!!strlen($value->body) > 40 ? '...' : ''!!}</td>
                            <td>{{ date('M j, Y',strtotime($value->created_at)) }}</td>
                            <td>{{ $value->user->name }}</td>
                            <td class="text-center">{{ $value->comments->count() }}</td>
                            <td class="text-center">
                                <a href="{{ route('blog.show', $value->id) }}" class="btn-sm btn-info"><i
                                        class="fas fa-eye"
                                        aria-hidden="true"></i>
                                </a>
                                @if(auth()->check() && auth()->user()->hasRole('admin'))
                                    <a href="{{ route('post.edit', $value->id) }}" class="btn-sm btn-warning"><i
                                            class="fas fa-pencil-alt"></i>
                                    </a>
                                @endif
                                @if(auth()->check() && auth()->user()->hasRole('moderator'))

                                    <button id="deletePost"
                                            class="btn-sm btn-danger fa-pull-right deleteComment"
                                            data-id="{{ $value->id }}"><i
                                            class="fa fa-trash"
                                            aria-hidden="true"></i>
                                    </button>

                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="col-12 text-center">
                    {{$blog->links("pagination::bootstrap-4")}}
                </div>
                <br/>
            </div>
        </div>
    </div>
@endsection
