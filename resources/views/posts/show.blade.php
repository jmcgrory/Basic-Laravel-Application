@extends('layouts.app')

@section('content')

<article>
  <a href="/posts" class="btn btn-success">Back</a>
  <h1>{{ $post->title }}</h1>
  <div class="content">
    {!! $post->body !!}
  </div>
  <hr>
  <small>Created on <time>{{ $post->created_at }}</time> by {{$post->user->name}}</small>
  <hr>
  @if(!Auth::guest())
    @if(Auth::user()->id == $post->user_id)
    <a href="/posts/{{$post->id}}/edit" class="btn btn-primary">Edit</a>
    {!!Form::open(
      [
        'action'=>['PostsController@destroy', $post->id],
        'method'=>'POST',
        'class'=>'float-right'
      ]
    )!!}
      {{Form::hidden('_method', 'DELETE')}}
      {{Form::submit('Delete', ['class'=>'btn btn-danger'])}}
    {!!Form::close()!!}
    @endif
  @endif
</article>

@endsection