@extends('layouts.app')

@section('content')


    <form action="/send" method="post">
    @csrf

        <button type="submit" class="btn btn-success">Submit</button>
    </form>


@endsection