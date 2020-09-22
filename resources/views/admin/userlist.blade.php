@extends('layouts.master')
@section('title','Userlistt')
@section('content')
    <div class="container">
        <h1 class="mt-2">User List</h1>

        @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <table class="table table-hover">

                    <thead>
                    <th>@sortablelink('name', 'Name')</th>
                    <th>@sortablelink('email','E-mail')</th>

                    @foreach($roles as $role)
                        <th class="text-center"> {{ $role->name }} </th>
                    @endforeach

                    <th></th>

                    </thead>

                    <tbody>
                    @foreach($users as $user)
                        <tr id="user {{$user->id}}">
                            <th> {{$user->name}} </th>
                            <td> {{$user->email}} </td>

                            @foreach($roles as $role)
                                <form method="post" action="{{ route('role.update', $user->id) }}">
                                    <input type="hidden" name="role_id" value="{{$role->id}}">
                                    @csrf
                                    <td class="text-center">
                                        <button type="submit" class="btn">
                                            @if($user->hasrole($role->slug))
                                                <input type="hidden" name="promote" value="0">
                                                <i class="fas fa-star" aria-hidden="true"></i>
                                            @else
                                                <input type="hidden" name="promote" value="1">
                                                <i class="far fa-star"></i>
                                            @endif
                                        </button>
                                    </td>
                                </form>
                            @endforeach
                            <td>
                                <a href="{{ route('user.edit', $user->id) }}" class="btn-sm btn-warning"><i class="fas fa-pencil-alt"></i>
                                </a>

                                @if(auth()->check() && auth()->user()->hasrole('admin'))

                                    <button id="deleteUser"
                                            class="btn-sm btn-danger fa-pull-right deleteUser"
                                            data-id="{{ $user->id }}"><i
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
                    {{$users->links("pagination::bootstrap-4")}}
                </div>
                <br/>
            </div>
        </div>
    </div>
@endsection
