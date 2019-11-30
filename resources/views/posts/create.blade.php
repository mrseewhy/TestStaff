@extends('pages.layout')
@section('head')
    Create
@endsection
@section('content')
   <div class="container mt-5 mb-4">
        <h2>Add New Staff To Database</h2>
        
        
        {!! Form::open(['action' => 'PostsController@store', 'method' => "POST", 'enctype'=>'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('name', 'Name:')}}
            {{Form::text('name', "", ['class'=>'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('role', 'Role:')}}
            {{Form::text('role', "", ['class'=>'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('phone', 'Phone Number:')}}
            {{Form::text('phone', "", ['class'=>'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('description', 'Description:')}}
            {{Form::textarea('description', "", ['class'=>'form-control', 'id'=> 'article-ckeditor'])}}
        </div>
        <div class="form-group">
                {{Form::file('cover_image')}}
        </div>
        {{Form::submit('Post', ['class'=>'btn btn-primary'])}}
        {!! Form::close() !!}

   </div>

@endsection