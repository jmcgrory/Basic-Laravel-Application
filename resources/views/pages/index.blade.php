@extends('layouts.app')

@section('content')
    <div class="jumbotron text-center">
        <h1>{{$title}}</h1>
        <p>Non sit enim eu occaecat in velit deserunt. Laborum consequat do elit dolore fugiat tempor culpa est. Amet laboris nisi aliquip eiusmod officia laborum ex qui. Duis adipisicing elit duis consequat.</p>
        <p>
            <a class="btn btn-primary btn-lg" href="/login" role="button">
                Login
            </a>
            <a class="btn btn-success btn-lg" href="/register" role="button">
                Register
            </a>
        </p>
    </div>
@endsection
