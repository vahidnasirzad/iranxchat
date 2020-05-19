@extends('main')
@section('title','users')

@section('content')
    <div class="card">
        <div class="card-header">Useres</div>
        <div class="card-body">
            <div class="table-responsive">

                <table class="table" id="my_table">
                    <thead>
                    <tr>
                        <td>ID</td>
                        <td>Name</td>
                        <td>Email</td>
                        <td>role</td>
                        <td>Action</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <h1 id="chat"></h1>
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->user_name }}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->roleName() }}</td>
                            <td>
                                @if($user->status == 0)
                                    <a href="{{url('usersus/' . $user->id)}}" class="btn btn-sm btn-danger">Suspend</a>
                                @else
                                    <a href="{{url('userunsus/' . $user->id)}}" class="btn btn-sm btn-danger">unSuspend</a>
                                @endif
                                @if(Auth::user()->role =='superadmin')
                                    <a href="{{url('deleteuser/' . $user->id)}}" class="btn btn-sm btn-warning">Delete</a>
                                @endif



                                <div class="dropdown" style="display:inline">
                                    <button class="btn btn-sm btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Charge
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{url('charge1/' . $user->id)}}">
                                            10,000
                                        </a>  <a class="dropdown-item" href="{{url('charge2/' . $user->id)}}">
                                            50,000
                                        </a>  <a class="dropdown-item" href="{{url('charge3/' . $user->id)}}">
                                            100,000
                                        </a>
                                    </div>
                                </div>
                                @if(Auth::user()->role == 'superadmin')
                                    @if($user->role == 'admin')
                                        <a href="{{url('useruser/' . $user->id)}}" class="btn btn-sm btn-primary">User</a>
                                    @elseif($user->role == 'user')
                                        <a href="{{url('adminuser/' . $user->id)}}" class="btn btn-sm btn-primary">Admin</a>
                                    @endif
                                @endif
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>

        </div>
    </div>

    @endsection
@section('script')
    <script>
        $(document).ready( function () {
            $('#my_table').DataTable();
        } );

    </script>
@endsection
