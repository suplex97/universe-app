<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    @extends('layouts.postlayout')

    @section('content')

    <div class="container col-md-4">
        <h2>{{ $user->name }}'s Posts</h2>
        @forelse($posts as $post)
            <div class="card mb-3">
                <div class="card-body">
                    <!-- Display post content -->
                    <div id="content-{{ $post->id }}">
                        <p>{{ $post->content }}</p>
                        <a href="javascript:void(0);" onclick="editPost({{ $post->id }})">Edit</a>
                        <form action="{{ route('post.destroy', ['post' => $post]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </div>
    
                    <!-- Edit form (initially hidden) -->
                    <div id="edit-form-{{ $post->id }}" style="display: none;">
                        <form action="{{ route('post.update', $post) }}" method="post">
                            @csrf
                            @method('PUT')
                            <textarea name="content">{{ $post->content }}</textarea>
                            <button type="submit">Save</button>
                            <button type="button" onclick="cancelEdit({{ $post->id }})">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p>No posts found for this user.</p>
        @endforelse
        
        <div class="d-flex justify-content-center mt-4">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
              <li class="page-item {{ ($posts->currentPage() == 1) ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $posts->previousPageUrl() }}">Previous</a>
              </li>
          
              {{-- Loop through the pages and create page number links --}}
              @foreach ($posts->getUrlRange(1, $posts->lastPage()) as $pageNum => $url)
                <li class="page-item {{ ($posts->currentPage() == $pageNum) ? 'active' : '' }}">
                  <a class="page-link" href="{{ $url }}">{{ $pageNum }}</a>
                </li>
              @endforeach
          
              <li class="page-item {{ ($posts->currentPage() == $posts->lastPage()) ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $posts->nextPageUrl() }}">Next</a>
              </li>
            </ul>
          </nav>
        </div>

    </div>

    <script>
        function editPost(postId) {
            document.getElementById('content-' + postId).style.display = 'none';
            document.getElementById('edit-form-' + postId).style.display = 'block';
        }
    
        function cancelEdit(postId) {
            document.getElementById('content-' + postId).style.display = 'block';
            document.getElementById('edit-form-' + postId).style.display = 'none';
        }
    </script>
    
    
    @endsection
</body>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>