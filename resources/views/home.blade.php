@extends('main')
@section('title')
    home
    @endsection
@section('content')
    @if(Auth::check())
        @php
            $chats = DB::table(DB::raw('('.
                DB::table('chats')->orderBy('id', 'desc')->take(5)->toSql()
        .') chats'))
        ->orderBy('id', 'asc')->get();
        @endphp


        <div class="card-group">
            <div class="card" style="background-color: #257eb9; opacity: 0.9; min-width: 400px;">
                <div class="card-header">Chat Room</div>
                <div class="card-body" id="chat" style="overflow-y: scroll; max-height: 400px;">
                    <div class="card" style="min-height: 300px">
                        <div class="card-body" id="chat_items" >
                            <ul class="list-group" id="list-group">
                                @foreach($chats as $chat)
                                    <li class="list-group-item" data-id="{{ $chat->id }}">
                                        <img src="{{'uploads/avatars/'. \App\User::find($chat->user_id)->avatar}}" style="width: 50px; height: 50px; float:left; border-radius: 50%; margin-right: 25px;position: absolute; z-index: 2;" class="img-circle" alt="">
                                        <div class='alert alert-secondary' style="margin: 25px" id="message"><b>{{ \App\User::find($chat->user_id)->user_name}}</b> : {{$chat->msg}}</div> <br>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card" style="background-color: #257eb9; opacity: 0.9; min-width: 300px;">
                <div class="card-header">Users</div>
                <div class="card-body" style="overflow-y: scroll; max-height: 400px;">
                    <div class="row" >
                        @foreach(\App\User::orderby('id', 'asc')->take(10)->get() as $user)
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="container" style="margin-top: 10px">
                                    <img class="card-img-top" src="/uploads/avatars/{{$user->avatar}}" style="width: 50px; height: 50px; float:left; border-radius: 50%; margin-right: 25px;" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title"><a href="{{url('uprofile/'.$user->id)}}" style="color: white;font-size: x-small;">{{$user->user_name}}</a></h5>

                                    </div>
                                    <div class="card-footer">
                                        <small class="text" id="online_{{$user->id}}">Offline</small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @else
    <h1 style="text-align: center"></h1>
    <div class="card bg-dark text-white">
        <img class="card-img" src="img/cover.gif" alt="Card image">
        <div class="card-img-overlay">
            <h5 class="card-title"></h5>
            <p class="card-text"></p>
            <p class="card-text"></p>
        </div>
    </div>
    <br>

<div class="container1">

    <div class="header"><span class="active"></span><span></span><span></span></div>
    <div class="fields">
        <div class="modal-body 1step is-showing">
            <div class="title">I am :</div>
            <div class="description"></div>
            <form>
            <!--  <input type="text" placeholder="Name"/>
                <input type="email" placeholder="Email"/> -->

                <label style="text-align: center; padding: 10px; margin: 10px;" class="lbl">
                    <input type="radio" name="radio" value="male" id="radio1"/>Male
                    <input type="radio" name="radio" value="fmale" id="radio2"/>Female
                    <input type="radio" name="radio" value="other" id="radio3"/>other
                </label>

                <div class="text-center">
                    <div class="button" id="start">START</div>
                </div>
            </form>
        </div>
        <div class="modal-body 2step">
            <div class="title">Step 2</div>
            <div class="description" id="register_error"></div>
            <form name="myform">
                <input type="text" id="username" placeholder="User Name" name="username"/>
                <input type="email" id="email" placeholder="Email" name="email"/>
                <input type="password" id="password" placeholder="Password" name="password"/>
                <input type="password" id="cpassword" placeholder="Confirm Password" name="cpassword"/>
                <div class="text-center fade-in">
                    <div class="button" id="submit">Next</div>
                </div>
            </form>
        </div>
        <div class="modal-body 3step">
            <div class="title">done.</div>
            <div class="description">Thanks For being member.</div>
            <div class="text-center">
                <div class="button">Done!</div>
            </div>
        </div>
    </div>
    </div>
    <div class="text-center">
        <div class="reStart"><a href="{{url('login')}}">Log in</a></div>
    </div>

<a href="#support">
    <img class="sticky" src="img/q.png" alt="Avatar">
</a>
</div>


@endif

@endsection
@section('script')
    <script>
        $('#submit').on('click',function(){
           let radioValue = $("input[name='radio']:checked").val();
           let username = $('#username').val();
           let email = $('#email').val();
           let password = $('#password').val();
           let cpassword = $('#cpassword').val();
           $.post("{{url('registeruser')}}",{
               radioValue,
               username,
               email,
               password,
               cpassword,
               '_token' : "{{csrf_token()}}"
           },function(res){

               });
        });




        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('51c843b58883dc2ec76e', {
            cluster: 'eu'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('chat-submited', function(data) {

            var res = JSON.parse(data.text);

            let message = $("#chat_items");
            message.append(" <li class='list-group-item'> "+
                "<img src='uploads/avatars/"+res.img +"' style=\"width: 50px; height: 50px; float:left; border-radius: 50%; margin-right: 25px;position: absolute; z-index: 2;\" class=\"img-circle\">"+
                "<div class='alert alert-secondary' style='margin: 25px'> " +
                "<b>" +res.name + "</b> : "+
                res.body +
                " </div> </li>");
            $('#chat').animate({scrollTop:$('#chat_items').height()}, 'slow');
        });





/*
        let loading = false;


        setInterval(function(){
            let last_id = $('#list-group').children(":last").attr('data-id');

            if (last_id < 0 || last_id == null)
                last_id = 0;

            if(!loading){
                loading = true;
                $.get("{{ url('listen') }}", {
                    last_id: last_id
                }, function (res) {
                    if(res !== '') {
                        $('#list-group').append(res);
                        $('#chat').animate({scrollTop:$('#chat_items').height()}, 'slow');
                    }
                    loading = false;
                })

            }

        }, 2000);*/
    </script>

    <script>

    </script>
    <script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
    <script  src="{{url('function.js')}}"></script>
    @endsection
