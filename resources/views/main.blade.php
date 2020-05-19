<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    <link rel="stylesheet" href="{{ url('css/emojionearea.min.css') }}">

    <script src="https://js.pusher.com/6.0/pusher.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <title>@yield('title')</title>
    <style>

        body {
            background-image: url('{{ url('img/back.png') }}');
            background-repeat: repeat;
        }

        ul {
            list-style: none;
        }

        hr {
            clear: both;
        }

        br {
            clear: both;
        }

        .footer {
            position:relative;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: rgb(40, 44, 49);
            color: white;
            text-align: center;
            padding: 16px;
        }
        .navbar-nav .dropdown-menu {
            position: absolute;
            float: none;
        }

        img.sticky {
            position: -webkit-sticky;
            position: sticky;
            bottom: 0;
            right: 0;
            float: right;
            width: 80px;
            opacity: 0.85;
        }
        img.sticky:hover {
            animation: shake 0.5s;
            animation-iteration-count: infinite;
            opacity: 1;
        }

        @keyframes shake {
            0% { transform: translate(1px, 1px) rotate(0deg); }
            10% { transform: translate(-1px, -2px) rotate(-1deg); }
            20% { transform: translate(-3px, 0px) rotate(1deg); }
            30% { transform: translate(3px, 2px) rotate(0deg); }
            40% { transform: translate(1px, -1px) rotate(1deg); }
            50% { transform: translate(-1px, 2px) rotate(-1deg); }
            60% { transform: translate(-3px, 1px) rotate(0deg); }
            70% { transform: translate(3px, 1px) rotate(-1deg); }
            80% { transform: translate(-1px, -1px) rotate(1deg); }
            90% { transform: translate(1px, 2px) rotate(0deg); }
            100% { transform: translate(1px, -2px) rotate(-1deg); }
        }
        .online {
            color:  #c7ffc2;
        }
        /*style for my chats  ------- -- - - - - --*/
        ul {
            margin: 0;
            padding: 0;
        }

        li {
            list-style: none;
        }

        .user-wrapper, .message-wrapper {
            border: 1px solid #dddddd;
            overflow-y: auto;
        }

        .user-wrapper {
            height: 600px;
        }

        .user {
            cursor: pointer;
            padding: 5px 0;
            position: relative;
        }

        .user:hover {
            background: #eeeeee;
        }

        .user:last-child {
            margin-bottom: 0;
        }

        .pending {
            position: absolute;
            left: 13px;
            top: 9px;
            background: #b600ff;
            margin: 0;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            line-height: 18px;
            padding-left: 5px;
            color: #ffffff;
            font-size: 12px;
        }

        .media-left {
            margin: 0 10px;
        }
        .media-left img {
            width: 64px;
            border-radius: 64px;
        }

        .media-body p {
            margin: 6px 0;
        }

        .message-wrapper {
            padding: 10px;
            height: 536px;
            background: #eeeeee;
        }

        .messages .message {
            margin-bottom: 15px;
        }

        .messages .message:last-child {
            margin-bottom: 0;
        }

        .received, .sent {
            width: 45%;
            padding: 3px 10px;
            border-radius: 10px;
        }

        .received {
            background: #ffffff;
        }

        .sent {
            background: #3bebff;
            float: right;
            text-align: right;

        }

        .message p {
            margin: 5px 0;
        }

        .date {
            color: #777777;
            font-size: 12px;
        }

        .active {
            background: #eeeeee;
        }

        .input-text input {
            width: 100%;
            padding: 12px 20px;
            margin: 15px 0 0 0;
            display: inline-block;
            border-radius: 4px;
            box-sizing: border-box;
            outline: none;
            border: 1px solid #cccccc;
        }

        input[type=text]:focus {
            border: 1px solid #aaaaaa;
        }

    </style>
</head>
<body>
@include('nav')
@if(Auth::check())
@include('users_nav')
<a href="{{url('mychats')}}">
    <img src="{{url('img/not.png')}}" style="float: right; width: 50px; height: auto;" alt="">
    <span class="badge badge-danger float-right" id="notification" style="margin-right: -30px"></span>
</a>

@endif
<audio id="beep">
    <source src="{{url('beep.ogg')}}" type="audio/ogg">
    <source src="{{url('beep.mp3')}}" type="audio/mpeg">
    Your browser does not support the audio element.
</audio>
@if(Auth::check())
<button onclick="abbas()" class="btn btn-success" >Sound on</button>
<a href="{{url('gift/'. Auth::user()->id)}}"><img src="{{url('img/gift.gif')}}" id="gift" alt=""></a>
@endif
<div class="container">

            <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
            <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

        @if(count($errors) > 0 )
            @foreach($errors->all() as $error )
                <div class="alert alert-danger">
                    {{$error}}
                </div>
                @endforeach
        @endif
        @if(session('login'))
            <script>
                Swal.fire(
                    'Logged in!',
                    'You Logged in to system !',
                    'success'
                )
            </script>
        @endif
        @if(session('gift'))
        <script>
            swal.fire(
                'Congratulations',
                'You Win 1000',
                'success'
            )
        </script>
            @endif
        @if(session('danger_msg'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "{{session('danger_msg')}}",

                })
            </script>
        @endif
    @if(session('success_msg'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Congratulations',
                text: "{{session('success_msg')}}",

            })
        </script>
    @endif
        @if(session('sus'))
            <div class="alert alert-danger">
                {{session('sus')}}
            </div>
        @endif
        @if(session('logout'))
            <div class="alert alert-success">
                {{session('logout')}}
            </div>
        @endif
        @if(session('register'))
            <div class="alert alert-success">
                {{session('register')}}
            </div>
        @endif
        <br>
        @yield('content')
    </div>

    @yield('script')
<script>


    function abbas() {
        x.play();
    }

    setInterval(function(){

        $.post("{{ url('set_last_seen') }}", {
            '_token': "{{ csrf_token() }}"
        }, function(res) {
            if (res === 'gift') {
                $('#gift').fadeIn('slow',function () {
                    $('#gift').delay('10000').fadeOut('slow');
                });
            }
        });

    }, 60000);

 /*   var x = document.getElementById("beep");

    var first = true;
    var zang = 0;

    setInterval(function(){

        $.post("{{ url('notification') }}", {
            '_token': "{{ csrf_token() }}"
        }, function(res) {
            document.querySelector('#notification').textContent = res;
            if(res > zang && !first) {
                abbas();
            }
            first = false;
            zang = res;
        });

    }, 2000);
*/
    setInterval(function(){
       $.post("{{url('online_users')}}", {
               '_token' : "{{csrf_token()}}"
           }, function(res) {
              for (let key in res) {
                  $('#online_' + key).text(res[key]);
                  if(res[key] === 'Online') {
                      $('#online_' + key).addClass('online');
                  } else {
                      $('#online_' + key).removeClass('text-success');
                  }
              }
           });
    }, 50000);

</script>
<script>
    var receiver_id = '';
    var my_id = "{{Auth::id()}}";
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('51c843b58883dc2ec76e', {
            cluster: 'eu'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('message-submited', function(data) {
            //alert(JSON.stringify(data));
            var res = JSON.parse(data.text);
            if (res.balance == 0){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'You Have Not Enough money!',
                    footer: '<a href>go to pardakht </a>'
                });
                return;
            }

            if (my_id == res.from){
                $('#' + res.to).click();
            } else if (my_id == res.to){
                if (receiver_id == res.from){
                    $('#' + res.from).click();
                } else {
                    var pending = parseInt( $('#' + res.from).find('.pending').html());

                    if (pending){
                        $('#' + res.from).find('.pending').html(pending + 1);
                    } else {
                        $('#' + res.from).append('<span class="pending">1</span>');
                    }
                }
            }
        });

        $('.user').click(function () {
            $('.user').removeClass('active');
            $(this).addClass('active');
            $(this).find('.pending').remove();

            receiver_id = $(this).attr('id');
            $.ajax({
               type:"get",
               url:"message/" + receiver_id,
               data: "",
               cache: false,
               success:function (data) {
                    $('#messages').html(data);
                   scrollToBottom();
                   $('.input-text input').get(0).focus();
               }
            });
        });

        $(document).on('keyup', '.input-text input', function (e) {
            var message = $(this).val();

            if (e.keyCode == 13 && message != '' && receiver_id != ''){
                $(this).val('');
                $('.input-text input').focus();
                var datastr = "receiver_id=" + receiver_id + "&message=" + message;
                $.ajax({
                    type: "post",
                    url: "message",
                    data: datastr,
                    cache: false,
                    success: function (data) {

                    },
                    error: function (jqXHR, status, err) {
                    },
                    complete: function () {
                        scrollToBottom();
                        $('.input-text input').focus();

                    }
                })
            }
        });
    });

    function scrollToBottom(){
        $('.message-wrapper').animate({
            scrollTop: $('.message-wrapper').get(0).scrollHeight
        }, 50);
    }
</script>


</body>
</html>
