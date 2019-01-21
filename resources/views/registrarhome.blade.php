@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Registrar</div>

                    <div class="panel-body">
                        <a href="/classrooms" class="btn btn-primary"> View Rooms</a>
                        <h3>Rooms</h3>
                        <table class="table table-striped">
                            <tr>
                                <th>Title</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach($classrooms as $classroom)
                                <tr>
                                    <td>{{$classroom->title}}</td>
                                    <td><a href="/classrooms{{$classroom->id}}/edit" class="btn btn-default">Edit</a></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
