@extends('layouts.app')

@section('content')
  <h1>Posts</h1>
  @if(count($posts)>=1)
    <div class="row">
    @foreach($posts as $post)
      <div class="col-sm-4 col-md-4">
        <div class="card">
            <img style="width:100%;height:auto;" src="/storage/cover_images/{{$post->cover_image}}" alt="{{ $post->title }} Cover Image">
          <div class="card-body">
              <h3>{{$post->title}}</h3>
              <p>
                Written on <time>{{$post->created_at}}</time> by {{$post->user->name}}
              </p>
              <a href="/posts/{{$post->id}}" class="btn btn-primary">View Post</a>
          </div>
        </div>
      </div>
    @endforeach
    </div>
    {{$posts->links()}}
  @else
    <p>No posts to show</p>
  @endif
@endsection