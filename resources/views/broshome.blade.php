@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="panel-body">
                        <a href="/venues/create" class="btn btn-primary"> Add Venue</a>
                        <h3>Venues</h3>
                        <table class="table table-striped">
                            <tr>
                                <th>Title</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach($venues as $venue)
                                <tr>
                                    <td>{{$venue->title}}</td>
                                    <td><a href="/posts{{$venue->id}}/edit" class="btn btn-default">Edit</a></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
