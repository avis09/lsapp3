@extends('layouts.app')

@section('content')
    <h1>Add equipments</h1>



    {!! Form::open(['action' => 'EquipmentsController@store', 'method' => 'POST' ,
    'enctype' => 'multipart/form-data']) !!}

        <label for="venue"> Venue </label>
        <select class="form-control" name="venue" id="venue" data-parsley-required="true">
            @foreach ($venueI['venue'] as $venueIs)
                {
                <option value="{{ $venueIs->venueID }}">{{ $venueIs->venueName }}</option>
                }
            @endforeach
        </select>
    <div class="form-group">

        {{Form::label('equipmentName', 'Equipment Name')}}
        {{Form::text('equipmentName', '', ['class' => 'form-control', 'placeholder'
        => 'Equipment Name'])}}
    </div>

    <div class="form-group">
        {{Form::label('barCode', 'Bar Code')}}
        {{Form::text('barCode', '', ['class' => 'form-control', 'placeholder'
        => 'Bar Code'])}}
    </div>
        <label for="equipmentstatus"> Equipment Status</label>
        <select class="form-control" name="equipmentstatus" id="equipmentstatus" data-parsley-required="true">
            @foreach ($equipmentstatusI['equipmentstatus'] as $equipmentstatusIs)
                {
                <option value="{{ $equipmentstatusIs->equipmentStatusID }}">{{ $equipmentstatusIs->equipmentStatusName }}</option>
                }
            @endforeach
        </select>

    </div>



    {{Form::submit('Add Equipment', ['class' => 'btn btn-primary'])}}
    {!! ! Form::close() !!}
@endsection