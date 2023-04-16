@extends('layouts.app')

@section('content')
<h1>Edit Post</h1>
{!! Form::model($post, ['method'=>'PATCH', 'action'=>['App\Http\Controllers\PostsController@update', $post->id]]) !!}
    @csrf
    <div class="form-group">
        {!! Form::label('title', 'Title:') !!}
        {!! Form::text('title', null, ['class'=>'form-control']) !!}
    </div>
    {!! Form::submit('Update Post', ['class'=>'btn btn-primary']) !!}
{!! Form::close() !!}

{!! Form::open(['method'=>'DELETE', 'action'=>['App\Http\Controllers\PostsController@destroy', $post->id]]) !!}
    @csrf

    {!! Form::submit('Delete Post', ['class'=>'btn btn-primary']) !!}
{!! Form::close() !!}
@endsection

@section('footer')

@endsection