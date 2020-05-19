@extends('main')
@section('title','Notification')
@section('content')

    <div class="card">
        <div class="card-header">Notification</div>
        <div class="card-body">
            <ul class="list-group">
                @foreach($conversations as $conversation)
                    <li class="list-group-item">
                        <img src="{{url('/uploads/avatars/' . \App\User::find($conversation->id)->avatar)}}" style="width: 50px; height: 50px; float:left; border-radius: 50%; margin-right: 25px;" class="img-circle" alt="profile" alt="">
                        <a href="{{ url('conversation/' . $conversation->id) }}">{{ \App\User::find($conversation->id)->user_name }}</a>
                        <span class="badge badge-success float-right">{{ $conversation->count }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>


@endsection

