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
                        <td>users</td>
                        <td>sender</td>
                        <td>receiver</td>
                        <td>costs</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($logs as $log)
                        <h1 id="chat"></h1>
                        <tr>
                            <td>{{$log->users}}</td>
                            <td>{{$log->sender->user_name}}</td>
                            <td>{{$log->receiver->user_name}}</td>
                            <td>{{$log->cost}}</td>
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
