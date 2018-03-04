@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <p>
                        <a href="/posts/create" class="btn btn-primary">Create Post</a>
                    </p>
                    <h3>Your Blog Posts</h3>
                    @if(count($posts)>0)
                        <table class="table table-striped">
                            <tr>
                                <th>Title</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{$post->title}}</td>
                                    <td>
                                        <a href="/posts/{{$post->id}}/edit" class="btn btn-primary">
                                            Edit
                                        </a>
                                    </td>
                                    <td>
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
                                    </td>
                                    <td>{{$post->created_at}}</td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <p>No posts to show</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
