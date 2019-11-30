@extends('pages.layout')
@section('head')
    {{$post->name}}
@endsection
@section('content')
   <!-- Page Content -->
  <div class="container">

    <!-- Page Heading/Breadcrumbs -->
    <h1 class="mt-4 mb-3">{{$post->name}}
        <small>by
          <a href="#">{{$post->user->name}}</a>
        </small>
      </h1>

    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="/">Home</a>
      </li>
      <li class="breadcrumb-item active"><a href="/posts">Staff</a></li>
      <li class="breadcrumb-item active">{{$post->name}}</li>
    </ol>
    <img class="img-fluid rounded" src="/storage/cover_images/{{$post->cover_image}}" alt="" style="width:100%">
    <p>Posted on {{$post->created_at}}, Last update at {{$post->updated_at}}</p>
    <hr>
    <div class="well">
            {!!$post->body!!}

    </div>
    
    
  </div>
<hr>
@if (!Auth::guest())
@if (Auth::user()->id == $post->user->id)
<div class="container p-3">
<a href="/posts/{{$post->id}}/edit" class="btn btn-warning btn-sm">Edit</a> 
{!! Form::open(['action'=>['PostsController@destroy', $post->id],'method' => 'POST', 'class' => 'pull-right']) !!}
{{Form::hidden('_method', 'DELETE') }}
{{Form::submit('delete', ['class'=>'btn btn-danger btn-sm'])}}
{!! Form::close() !!}

</div>
@endif
@endif
  </div>
  <!-- /.container -->
@endsection