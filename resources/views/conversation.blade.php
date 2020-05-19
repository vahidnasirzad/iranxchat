@extends('main')
@section('title','Conversation')
@section('content')

    @if(Auth::check())
        <div class="card mt-3">
            <div class="card-header">{{ $user->user_name }}</div>
            <div class="card-body" id="cnv" style="overflow-y: scroll;max-height: 400px;">

                <div class="card" style="min-height: 300px">
                    <div class="card-body" id="chat_items">
                        <ul class="list-group" id="list-group">
                            @foreach($conversations as $conversation)
                                <li class="list-group-item" data-id="{{ $conversation->id}}">
                                    <img src="/uploads/avatars/{{$conversation->sender->avatar}}" style="width: 50px; height: 50px; float:left; border-radius: 50%; margin-right: 25px;" class="img-circle" alt="profile">
                                    <b>{{ $conversation->sender->user_name}} :</b>
                                    <small>{{ $conversation->msg }}</small>
                                    <span class="text-info" style="float: right !important;">{{ \Carbon\Carbon::createFromTimeString($conversation->created_at)->ago() }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body form-inline">
                        <input type="text" style="width: 80%" class="form-control" id="msg">
                        <button id="send" style="width: 20%" class="btn btn-success" style="float: left">send</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('script')
    @auth()
        <script>
            var x = document.getElementById("beep");

            function playAudio() {
                x.play();
            }

            $('#send').on('click',function(){
                send();
            });

            function send(){
                let msg = $('#msg').val();
                if(msg === ''){
                    Swal.fire("it cant't be empty");
                }
                else{
                    $.post("{{url('get_cnv')}}",{
                            '_token':'{{csrf_token()}}',
                            msg,
                            'receiver': "{{ $user->id }}"
                        },
                        function(res){
                            if(res === 'notenough'){
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Not Enough Money!',
                                    footer: '<a href>GO 4 Pay</a>'
                                })
                            }
                            document.querySelector('#msg').value = '';
                            document.querySelector('#balance').textContent = res;
                        }
                    );
                }
            }

            setInterval(function(){
                let last_id = $('#list-group').children(":last").attr('data-id');

                if (last_id < 0 || last_id == null)
                    last_id = 0;

                $.get("{{ url('listencnv') }}", {
                    last_id : last_id,
                    user : '{{$user->id}}'
                }, function (res) {
                    if(res !== '') {
                        $('#list-group').append(res);
                        $('#cnv').animate({scrollTop:$('#chat_items').height()}, 'slow');
                    }
                })
            }, 3000);

            $('#msg').on('keyup', function(event) {
                if (event.keyCode === 13) {
                    // Cancel the default action, if needed
                    event.preventDefault();
                    // Trigger the button element with a click
                    send();
                    document.getElementById("msg").value = '';
                }
            });

        </script>
    @endauth

@endsection
