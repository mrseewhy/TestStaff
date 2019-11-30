@extends('pages.layout')
@section('head')
    Create
@endsection
@section('content')
   <div class="container mt-5 mb-4">
        <h2>Edit Post</h2>
        
        
        {!! Form::open(['action' => ['PostsController@update', $post->id], 'method' => "POST", 'enctype'=>'multipart/form-data']) !!}
        
        <div class="form-group">
            {{Form::label('name', 'Name:')}}
            {{Form::text('name', $post->name, ['class'=>'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('role', 'Role:')}}
            {{Form::text('role', $post->role, ['class'=>'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('phone', 'Phone Number:')}}
            {{Form::text('phone', $post->phone, ['class'=>'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('description', 'Description:')}}
            {{Form::textarea('description', $post->description, ['class'=>'form-control', 'id'=> 'article-ckeditor'])}}
        </div>
        <div class="form-group">
                {{Form::file('cover_image')}}
        </div>
        {{Form::hidden('_method', 'PUT') }}
        {{Form::submit('Update', ['class'=>'btn btn-primary'])}}
        {!! Form::close() !!}

        


   </div>

@endsection