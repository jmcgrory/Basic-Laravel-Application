@extends('layouts.app')

@section('content')

<article>
  <a href="/posts" class="btn btn-default">Back</a>
  <h1>{{ $post->title }}</h1>
  <div class="content">
    {!! $post->body !!}
  </div>
  <small>Created on <time>{{ $post->created_at }}</time></small>
</article>

@endsection