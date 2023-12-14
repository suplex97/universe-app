<!-- resources/views/posts/index.blade.php -->
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HOME</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>


    <!-- Loop through each post (if you have multiple posts) -->
    @foreach($posts as $post)
    <div class="card mb-3">
        <!-- Display the image if it exists -->
        @if($post->image)
            <img src="{{ asset('path/to/images/' . $post->image) }}" alt="Post Image">
        @endif

        <!-- Display post content -->
        <div class="card-body">
            <p>{{ $post->content }}</p>

            <!-- Interactive buttons -->
            <div class="actions">
                <!-- Like Button -->
                <button class="like-btn">Like</button>
                <!-- Comment Button -->
                <button class="comment-btn">Comment</button>
            </div>

            <!-- Display comments section -->
            @if($post->comments)
                <div class="comments">
                    @foreach($post->comments as $comment)
                        <div class="comment">{{ $comment->content }}</div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    @endforeach
    @yield('content')

    


    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>