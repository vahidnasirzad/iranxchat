@extends('main')
@section('title','onlineusers')
@section('content')

    <div class="container">
        <div class="row">
            @foreach($users as $user)
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card ">
                        <img class="card-img-top" src="/uploads/avatars/{{$user->avatar}}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title"><a href="{{url('uprofile/'.$user->id)}}">{{$user->user_name}}</a></h5>
                            <p class="card-text">{{$user->bio}}</p>
                            <a href="{{url('conversation/' . $user->id)}}" class="btn btn-success">chat</a>
                            <a href="#" class="btn btn-primary">transfer</a>
                            <a href="#" class="btn btn-primary">Gallery</a>

                            @if($user->isBlocked())
                                <a href="{{ url('unblock/' . $user->id) }}" class="btn btn-info">Unblock</a>
                            @else
                                <a href="{{url('block/' . $user->id)}}" class="btn btn-danger">Block</a>
                            @endif


                        </div>
                        <div class="card-footer">
                            <small class="text" id="online_{{$user->id}}">Offline</small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
