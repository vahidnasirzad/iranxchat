<a href="{{url('chatroom')}}" > <img id="chaticon" src="{{url('img/chaticon.png')}}" alt=""> </a>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">



    <!-- Navbar text-->
    @if(Auth::check())

    <span class="navbar-text">
        Your balance is : <span id="balance">{{ Auth::User()->balance }}</span>
  </span>
        <!-- Links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">

            </li>
        </ul>
        <ul class="navbar-nav ml-auto ">
            <li class="nav-item">

                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{Auth::User()->user_name}}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{url('profile/'.Auth::user()->id)}}">
                            {{"profile"}}
                        </a>
                        @if(Auth::user()->role == 'superadmin')
                                <a class="dropdown-item" href="{{url('admin\users')}}">Users</a>
                                <a class="dropdown-item" href="{{url('admin\logs')}}">logs</a>
                                <a class="dropdown-item" href="{{url('admin\receipts')}}">receipts</a>
                        @elseif(Auth::user()->role == 'admin')
                                <a class="dropdown-item" href="{{url('admin\users')}}">Users</a>
                            @endif
                            <a class="dropdown-item" href="{{url('logout')}}">Logout</a>
                    </div>
                </div>


            </li>
        </ul>
    @endif
</nav>
