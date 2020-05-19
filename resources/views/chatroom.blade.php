@extends('main')
@section('title','chatroom')
@section('content')
    @php
        $chats = DB::table(DB::raw('('.
            DB::table('chats')->orderBy('id', 'desc')->take(10)->toSql()
    .') chats'))
    ->orderBy('id', 'asc')->get();
    @endphp

    @if(Auth::check())
        <div class="card mt-3">
            <div class="card-header">Iran X Chat</div>
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
                <div class="card">
                    <div class="card-body form-inline">
                        <input type="text" style="width: 80%" class="form-control" id="msg">
                        <button id="send" style="width: 20%" class="btn btn-success" style="float: left">>></button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @endsection
@section('script')
    @auth()

        <script>

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
        </script>
        <script>

            $('#msg').focus();


            $('#send').on('click',function(){
                send();
            });


            function send () {
                let msg = $('#msg').val();
                if(msg === ''){
                    Swal.fire("it cant't be empty");
                }
                else{
                    $.post("{{url('/sender')}}",{
                            '_token':'{{csrf_token()}}',
                            msg
                        },
                        function(res){
                            console.log(res);
                            if(res === 'notenough')
                            {Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'You Have Not Enough money!',
                                footer: '<a href>go to pardakht </a>'
                            });}


                            document.querySelector('#msg').value = '';
                            document.querySelector('#balance').textContent = res;

                            $('#msg').focus();
                        }
                    );
                }
            }
            $('#msg').on('keyup', function(event) {
                if (event.keyCode === 13) {
                    // Cancel the default action, if needed
                    event.preventDefault();
                    // Trigger the button element with a click
                    send();
                    document.getElementById("msg").value = '';
                }
            });
            /*
                        let loading = false;

                        setInterval(function(){
                            let last_id = $('#list-group').children(":last").attr('data-id');

                            if (last_id < 0 || last_id == null)
                                last_id = 0;

                            if(!loading) {
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

            }, 2000);

           /!* var input = document.getElementById("msg");

            // Execute a function when the user releases a key on the keyboard
            input.addEventListener("keyup", function(event) {
                // Number 13 is the "Enter" key on the keyboard
                if (event.keyCode === 13) {
                    // Cancel the default action, if needed
                    event.preventDefault();
                    // Trigger the button element with a click
                    document.getElementById("send").click();
                    document.getElementById("msg").value = '';
                }
            });*!/

            $('#msg').on('keyup', function(event) {
                if (event.keyCode === 13) {
                    // Cancel the default action, if needed
                    event.preventDefault();
                    // Trigger the button element with a click
                    send();
                    document.getElementById("msg").value = '';
                }
            });
*/

        </script>
        <script src="{{url('emojionearea.min.js')}}"></script>
        <script>
            $(document).ready(function () {
                $('#msg').emojioneArea();
            });
        </script>
    @endauth

    @endsection
