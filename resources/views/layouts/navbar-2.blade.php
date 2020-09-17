<nav class="navbar navbar-expand-lg navbar-dark bg-dark mainNav">
    <div class="container">
        <a class="navbar-brand" href="">First Laravel</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a href="{{ url('/blog') }}" class="nav-link">Blog</a>
                </li>
            </ul>

            @if(auth()->check())
                <ul class="navbar-nav my-md-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">{{Auth::user()->name}}</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item nav-item" href="/user/profile">Profile</a>
                            <a class="dropdown-item nav-item" href="#">Settings</a>
                            <hr/>
                            @if(auth()->check() && auth()->user()->hasRole('admin', 'creator'))

                                <a href="{{url('/post/createpost')}}" class="dropdown-item nav-item">Create Post</a>
                                <hr/>
                            @endif
                            @if(auth()->user()->hasRole('moderator'))

                                <a href="{{url('/post/viewposts')}}" class="dropdown-item nav-item">Post List</a>
                                <a href="{{url('/user/userlist')}}" class="dropdown-item nav-item">User List</a>
                                <hr/>
                            @endif
                            <form method="post" action=" {{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); this.closest('form').submit();"
                                   class="dropdown-item">Logout</a>
                            </form>
                        </div>
                    </li>
                </ul>

            @else
                <a href="{{ url('login') }}">
                    <button id="loginButton" class="btn btn-outline-light my-2 my-sm-0" type="submit">Login</button>
                </a>
            @endif

        </div>
    </div>

</nav>
