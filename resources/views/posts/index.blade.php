@extends('pages.layout')
@section('head')
    Staff Members
@endsection
@section('content')
   <!-- Page Content -->
  <div class="container">

    <!-- Page Heading/Breadcrumbs -->
    <h1 class="mt-4 mb-3">List Staff Members
      
    </h1>

    {{-- <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="/">Home</a>
      </li>
      <li class="breadcrumb-item active">Staff</li>
    </ol> --}}

    <!-- Blog Post -->
    @if (count($posts) > 0)
        @foreach ($posts as $post)
    <div class="card mb-4">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-6">
            <a href='posts/{{$post->id}}'>
              <img class="img-fluid rounded" src="/storage/cover_images/{{$post->cover_image}}" alt="" style="width:100%">
            </a>
          </div>
          <div class="col-lg-6">
          <h2 class="card-title"><a href='posts/{{$post->id}}'>{{$post->name}}</a></h2>
            <p class="card-text">@if(strlen($post->body)>200)                                     
                                {!!substr(strip_tags($post->description),0,200)!!}...
                                @else
                                {!!$post->description!!}
                                @endif</p>
            <a href="posts/{{$post->id}}" class="btn btn-primary">Read More &rarr;</a>
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
               Role:  {{$post->role}}
              </li>
              <li class="breadcrumb-item active">Phone Number: {{$post->phone}}</li>
            </ol>
          </div>
        </div>
      </div>
      <div class="card-footer text-muted">
        Posted on {{$post->created_at}} by
        <a href="#">{{$post->user->name}}</a>
      </div>
    </div>
            
        @endforeach
        @else <p>"No Post Found"</p>
    @endif
    <!-- Pagination -->
    {{$posts->links()}}

  </div>

  </div>
  <!-- /.container -->
@endsection