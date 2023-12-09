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
    <div class="row justify-content-center">
        <button type="button" class="btn btn-light col-md-6 m-5" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="border-radius: 1.365rem;">
            What's on your mind, {{ Auth::user()->name }}
        </button>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Create a new post</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="content">Post Content</label>
                        <textarea class="form-control post-input" id="content" name="content" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">Upload Image</label>
                        <input type="file" class="form-control post-input" id="image" name="image">
                    </div>
                    <div class="form-group">
                        <label for="link">Insert Link</label>
                        <input type="text" class="form-control post-input" id="link" name="link">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="createPostBtn" disabled>Create Post</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Enable the "Create Post" button if any input has a value
    document.querySelectorAll('.post-input').forEach(function (input) {
        input.addEventListener('input', function () {
            const createPostBtn = document.getElementById('createPostBtn');
            createPostBtn.disabled = areAllInputsEmpty();
        });
    });

    function areAllInputsEmpty() {
        const inputs = document.querySelectorAll('.post-input');
        for (const input of inputs) {
            if (input.value.trim() !== '') {
                return false; // At least one input is not empty
            }
        }
        return true; // All inputs are empty
    }
</script>




<div class="container col-md-8">
    <h2>Posts</h2>
    @foreach($posts as $post)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">
                    @if($post->user)
                        <a href="{{ route('user.profile', ['user' => $post->user]) }}">{{ $post->user->name }}</a>
                    @else
                        User Not Found
                        @php dd($post->toArray()) @endphp
                    @endif
                </h5>
                <p class="card-text">
                    @if($post->post_type === 'text')
                        <strong>Content:</strong> {{ $post->content }}
                    @elseif($post->post_type === 'photo')
                        @if($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="img-fluid">
                        @endif
                    @elseif($post->post_type === 'link')
                        @if($post->link)
                        <strong>Link:</strong> <a href="{{ $post->link }}" target="_blank">{{ $post->link }}</a>
                        @else
                            <strong>Link:</strong> (No link provided)
                        @endif
                    @elseif($post->post_type === 'image-text')
                        @if($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="img-fluid">
                        @endif
                        <strong>Content:</strong> {{ $post->content }}
                    @endif
                </p>
                <p class="card-text">
                    <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                </p>
            </div>
        </div>
    @endforeach
</div>









@endsection

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>