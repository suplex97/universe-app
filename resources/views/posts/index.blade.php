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

<div class="container col-md-4">
    <h2 class="mb-4">Posts</h2>

    @foreach($posts as $post)
        <div class="card mb-4">
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
                            <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="img-fluid rounded">
                        @endif
                    @elseif($post->post_type === 'link')
                        @if($post->link)
                            <strong>Link:</strong> <a href="{{ $post->link }}" target="_blank">{{ $post->link }}</a>
                        @else
                            <strong>Link:</strong> (No link provided)
                        @endif
                    @elseif($post->post_type === 'image-text')
                        @if($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="img-fluid rounded">
                        @endif
                        <strong>Content:</strong> {{ $post->content }}
                    @endif
                </p>
                <p class="card-text">
                    <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                </p>
                <div class="d-flex justify-content-between align-items-center">
                    <!-- Add icons for comment, like, and share -->
                    <div class="btn-group">
                        @php
                        $isLikedByUser = $post->likes->contains('user_id', auth()->id());
                        @endphp
                        <button type="button" class="btn {{ $isLikedByUser ? 'btn-primary' : 'btn-outline-secondary' }} like-btn" onclick="likePost({{ $post->id }}, this)">
                            <i class="bi bi-heart"></i> Like
                        </button>
                        
                        <button type="button" class="btn btn-outline-secondary comment-btn" data-bs-toggle="modal" data-bs-target="#commentModal" data-post-id="{{ $post->id }}">
                            <i class="bi bi-chat"></i> Comment
                        </button>                            
                        
                    </div>                 
                    <span id="likes-count-{{ $post->id }}">
                        likes: {{ $post->likes ? $post->likes->count() : 'No likes relationship' }}
                    </span>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="modal" tabindex="-1" id="commentModal">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Comment</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div id="comments-section">
                <!-- Comments will be dynamically added here -->
            </div>
        <div class="modal-footer">
            <div class="input-group mb-3">
                <input type="text" id="comment-input" class="form-control" placeholder="Write a comment...">
                <button class="btn btn-outline-secondary" type="button" id="post-comment-btn">Post</button>

            </div>
        </div>
    </div>
    </div>
</div>



<script> //AJAX to handle the like functionality
    function likePost(postId, buttonElement) {
    fetch('/like/' + postId, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ postId: postId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById('likes-count-' + postId).innerText = 'Likes: ' + data.likes;
            buttonElement.classList.toggle('btn-primary');
            buttonElement.classList.toggle('btn-outline-secondary');
        }
    })
    .catch(error => console.error('Error:', error));
}

</script>

    <script> // Proceed with AJAX request to submit comment
        document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.comment-btn').forEach(button => {
            button.addEventListener('click', function() {
                var postId = this.getAttribute('data-post-id');
                var commentSection = document.getElementById('comments-section');
                commentSection.innerHTML = ''; // Clear existing comments
                // Update the comment button in the modal for the current post
                document.getElementById('post-comment-btn').onclick = function() {
                    postComment(postId);
                };

                

                // AJAX request to load comments for the selected post
                fetch('/load-comments/' + postId)
                .then(response => response.json())
                .then(data => {
                        data.comments.forEach(comment => {
                            console.log('Comment ID:', comment.id); 
                            var commentDiv = document.createElement('div');
                            commentDiv.id = 'comment-' + comment.id; // Assigning ID
                            commentDiv.classList.add('comment');
                            //var commentHtml = `<p>${comment.text}</p>`;
                            // Include user name and profile link in the comment HTML
                            var commentHtml = `<p><strong><a href="/user/profile/${comment.userId}">${comment.userName}</a></strong>: ${comment.text}</p>`;

                            // Check if the current user is an admin
                            if (isAdmin) { // 'isAdmin' should be a boolean variable set in your frontend
                                commentHtml += `
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            ...
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <li><a class="dropdown-item" href="#" onclick="editComment(${comment.id}, '${comment.text}')">Edit</a></li>
                                            <li><a class="dropdown-item" href="#" onclick="confirmDelete(${comment.id})">Delete</a></li>
                                        </ul>
                                    </div>`;
                            }

                            commentDiv.innerHTML = commentHtml;
                            document.getElementById('comments-section').appendChild(commentDiv);
                        });
                    })

                .catch(error => console.error('Error loading comments:', error));
            });
        });
    });

            function createCommentHTML(comment) {
var commentHtml = `<div id="comment-${comment.id}" class="comment">
    <p><strong><a href="/user/profile/${comment.userId}">${comment.userName}</a></strong>: ${comment.text}</p>`;

if (isAdmin) {
    commentHtml += `
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                ...
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="#" onclick="editComment(${comment.id}, '${comment.text}')">Edit</a></li>
                <li><a class="dropdown-item" href="#" onclick="confirmDelete(${comment.id})">Delete</a></li>
            </ul>
        </div>`;
}

commentHtml += `</div>`;
return commentHtml;
}

        
        
        function postComment(postId) {
            var commentInput = document.getElementById('comment-input');
            var commentText = commentInput.value;
        
            if (commentText.length > 200) {
                alert("Comments can't be longer than 200 characters. Try shortening your comment.");
                return;
            }
        
            // Proceed with AJAX request to submit comment
            // ...
            fetch('/comment/' + postId, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ comment: commentText })
            })
            .then(response => response.json())
            .then(data => {
            if (data.success) {
                var commentSection = document.getElementById('comments-section');
                var newComment = document.createElement('div');
                newComment.innerHTML = '<strong><a href="/user/profile/' + data.userId + '">' + data.userName + '</a></strong>: ' + data.commentText;
                commentSection.appendChild(newComment);
                commentInput.value = ''; // Clear the input field
            }
        })
        .catch(error => console.error('Error:', error));
        }
        
        function editComment(commentId, commentText) {
                        var commentDiv = document.getElementById('comment-' + commentId);
            if (commentDiv) {
                var originalCommentHtml = commentDiv.innerHTML;

                var editHtml = `
                    <div class="input-group mb-3">
                        <input type="text" id="edit-input-${commentId}" class="form-control" value="${commentText}">
                        <button class="btn btn-primary" onclick="submitEdit(${commentId}, \`${originalCommentHtml}\`)">Save</button>
                        <button class="btn btn-secondary" onclick="cancelEdit(${commentId}, \`${originalCommentHtml}\`)">Cancel</button>
                    </div>
                `;

                commentDiv.innerHTML = editHtml;
            }
        }

        function submitEdit(commentId) {
                        var editedText = document.getElementById('edit-input-' + commentId).value;

        // AJAX call to update the comment on the server
        // On success, revert back to original comment display with updated text
        // For now, let's revert back without waiting for AJAX response
        var commentDiv = document.getElementById('comment-' + commentId);
        if (commentDiv) {
            commentDiv.innerHTML = originalCommentHtml.replace(commentText, editedText);
        }
        }

        function cancelEdit(commentId, originalText) {
            // Replace the input field back with the original comment text
                        var commentDiv = document.getElementById('comment-' + commentId);
            if (commentDiv) {
                commentDiv.innerHTML = originalCommentHtml;
            }
        }


        function confirmDelete(commentId) {
            console.log('Deleting comment with ID:', commentId); // Debugging
            if (confirm('Are you sure you want to delete this comment?')) {
                // AJAX call to delete the comment
                fetch('/delete-comment/' + commentId, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        var commentDiv = document.getElementById('comment-' + commentId);
                        if (commentDiv) {
                            commentDiv.remove();
                        }
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        }
</script>

<script>
    var isAdmin = @json(auth()->user()->isAdmin()); // Or the equivalent check for admin role
</script>

    









@endsection

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>