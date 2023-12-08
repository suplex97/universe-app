<!-- resources/views/posts/create.blade.php -->

@extends('layouts.postlayout')

@section('content')
    <div class="container">
        <h2>Create a new post</h2>
        <form action="{{ route('post.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="content">Post Content</label>
                <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Create Post</button>
        </form>
    </div>
@endsection
