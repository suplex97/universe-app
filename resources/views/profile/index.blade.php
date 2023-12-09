<div class="container col-md-4">
    <h2>{{ $user->name }}'s Posts</h2>
    @foreach($posts as $post)
        <div class="card mb-3">
            <div class="card-body">
                <!-- Display post content -->
                <p>{{ $post->content }}</p>

                <!-- Add update and delete buttons -->
                <a href="{{ route('post.edit', ['post' => $post]) }}">Edit</a>
                <form action="{{ route('post.destroy', ['post' => $post]) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </div>
        </div>
    @endforeach
</div>
