@extends('main')

@section('title', 'Login')

@section('content')

    <div class="card">
        <div class="card-header">Login</div>
        <div class="card-body">
            <form action="{{ url('login') }}" method="post">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" class="form-control" value="{{ old('email') }}">
                    <small class="form-text text-muted" id="help">Enter email please</small>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control">
                    <small class="form-text text-muted" id="help">Enter Password please</small>

                </div>
                <input type="submit" class="btn btn-info">
            </form>
        </div>
    </div>

    @endsection

@section('script')
    <script>
        $('#email').on('keyup', function () {
            let email = $(this).val();
            $.get("{{ url('check') }}", {
                email
            }, function(response) {
                document.querySelector('#help').textContent = response;
            });
        });
    </script>
    @endsection
