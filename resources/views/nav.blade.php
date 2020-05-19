{{--
<ul class="navbar navbar-dark bg-dark">
    <li class="nav-item">
        <a class="nav-link active" href="{{url('home')}}">
            <button class="btn btn-outline-success" type="button">Home</button>
            </a>
    </li>
    <li class="nav-item">

        <a  href="{{url('onlineusers')}}">
            <button class="btn btn-outline-success" type="button">Online Users</button>
        </a>
    </li>
    @if(Auth::check())
    <li class="nav-item">
        <a class="nav-link" href="{{url('logout')}}">
            <button class="btn btn-outline-success" type="button">Logout</button>
        </a>
    </li>
        @if(Auth::user()->role == 1)
            <li class="nav-item">
                <a class="nav-link" href="{{url('admin/users')}}">
                    <button class="btn btn-outline-success" type="button">Users</button>
                </a>
            </li>
            @endif
    @else
    <li class="nav-item">
        <a class="nav-link" href="{{url('login')}}">
            <button class="btn btn-outline-success" type="button">Login</button>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{url('register')}}">
            <button class="btn btn-outline-success" type="button">Register</button>
        </a>
    </li>
    @endif
</ul>
--}}
<nav class="navbar navbar-expand-lg navbar-light bg-custom" style="background-color: #1e6594">
    <a class="navbar-brand" href="{{url('home')}}" style="color: white">IrXCN</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{url('home')}}" style="background-color: #1e6594; color: white;">Home <span class="sr-only">(current)</span></a>
            </li>
            @if(Auth::check())
            <li class="nav-item">
                <a class="nav-link" href="{{url('logout')}}" style="color: white">Logout</a>
            </li>
             @else
                <li class="nav-item">
                <a class="nav-link" href="{{url('login')}}" style="color: white">Login</a>
            </li>
            @endif


            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" style="color: white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    filans
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{url('onlineusers')}}">All Users</a>
                    <a class="dropdown-item" href="{{url('receipt')}}">Charge Account</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#"></a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#"style="color: white">IrXCH</a>
            </li>
        </ul>
    </div>
</nav>
