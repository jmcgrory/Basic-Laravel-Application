@extends('layouts.app')

@section('content')
    <h1>{{$title}}</h1>
    <p>Proident laborum anim incididunt sit anim qui aute. Pariatur non et sit Lorem ipsum sunt ad ut ut est. Est quis enim duis fugiat consequat irure laboris. Sunt ad minim do veniam pariatur qui nisi.</p>
    @if(count($services)>0)
        <ul class="list-group">
            @foreach($services as $service)
                <li class="list-group-item">{{$service}}</li>
            @endforeach
        </ul>
    @endif
@endsection
