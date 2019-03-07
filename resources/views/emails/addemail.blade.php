@extends('layouts.app')

@section('content')
    <h1>Send Email</h1>
    <div class="container box">

        <form method="POST" action="/lsapp/public/sendmail">
    @csrf
            {{ csrf_field() }}
            <div class="form-group">
                <label>Enter Your Name</label>
                <input type="text" name="name" class="form-control" />
            </div>
            <div class="form-group">
                <label>Enter Your Email</label>
                <input type="text" name="email" class="form-control" />
            </div>
            <div class="form-group">
                <label>Enter your Message</label>
                <textarea name="message" class="form-control">

                </textarea>
            </div>
            <div class="form-group">
                <input type="submit" name="send" value="Send" class="btn btn-info" />

            </div>

        </form>

    </div>

@endsection