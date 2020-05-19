@extends('main')
@section('title','Notification')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="user-wrapper">
                <ul class="users">
                    @foreach($users as $user)
                    <li class="user" id="{{$user->id}}">
                        @if($user->unread)
                            <span class="pending">{{$user->unread}}</span>
                        @endif
                        <div class="media">
                            <div class="media-left">
                                <img src="{{url('uploads/avatars') .'/' . \App\User::find($user->id)->avatar}}" alt="" class="media-object">
                            </div>
                            <div class="media-body">
                                <p class="name">{{$user->user_name}}</p>
                                <p class="email">{{$user->email}}</p>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-md-8" id="messages">

        </div>
    </div>
</div>


@endsection
