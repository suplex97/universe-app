<!-- resources/views/posts/index.blade.php -->
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HOME</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>


@extends('layouts.postlayout')

@section('content')


<div class="container">
    <div class="row justify-content-center ">
       <button type="button" class="btn btn-light col-md-6 m-5" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="
        border-radius: 1.365rem;">
        What's on your mind, {{ Auth::user()->name }}
      </button>
    </div>
 </div>

 <!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
    <form action="{{ route('post.store') }}" method="post">
    <div class="modal-header">
      <h1 class="modal-title fs-5" id="staticBackdropLabel">Create a new post</h1>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
            @csrf
            <div class="form-group">
                <label for="content">Post Content</label>
                <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
            </div>
 
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-primary">Create Post</button>
    </div>
</form>
  </div>
</div>
</div>

<div class="container col-md-4">
        <h2>Posts</h2>
        @foreach($posts as $post)
            <div class="card mb-3">
                <div class="card-body">
                    {{ $post->content }}
                </div>
            </div>
        @endforeach
    </div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>