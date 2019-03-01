@extends('layouts.app')

@section('content')
    <h1>Venues with Equipments</h1>
    <hr>

    @if(count($equipment) > 0)

        @foreach($equipment as $equip)
            <div class="well">
                <a href="/users/{{$equip->equipmentID}}">{{$equip->equipmentName}}</a>
                {{--<div>--}}
                    {{--{!!$equip->f_equipmentStatus->equipmentStatusName!!}--}}
                {{--</div>--}}
                <hr>
                </ol>
                @endforeach
                @else
                    <p>No posts found</p>
            @endif
@endsection