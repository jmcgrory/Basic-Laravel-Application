@extends('layouts.app')

@section('content')
  <h1>Posts</h1>
  @if(count($posts)>=1)
    @foreach($posts as $post)
      <article class="well">
        <h3>{{$post->title}}</h3>
        <small>Written on <time>{{$post->created_at}}</time></small>
        <p>
        <a href="/posts/{{$post->id}}" class="btn btn-primary">View Post</a>
        </p>
      </article>
    @endforeach
    {{$posts->links()}}
  @else
    <p>No posts to show</p>
  @endif
@endsection