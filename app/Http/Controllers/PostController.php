<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\like;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->get();
        return view('posts.index', compact('posts'));
        $posts = Post::with('likes')->get(); // Eager load likes
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
// app/Http/Controllers/PostController.php

public function store(Request $request)
{
    // Validate the request
    $request->validate([
        'content'   => 'nullable|max:255',
        'image'     => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        'link'      => 'url|nullable',
    ]);

    // Handle file upload if an image is provided
    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('images', 'public');
    }
   

    // Automatically determine post type based on content
    $postType = $this->determinePostType($request->input('content'), $imagePath, $request->input('link'));

    // Explicitly check and set 'content' value
    $content = $request->input('content');
    if ($content === null) {
        $content = ''; // Set default value if 'content' is null
    }

    // Create a new post
    auth()->user()->posts()->create([
        'content'   => $content,
        'image'     => $imagePath,
        'link'      => $request->input('link'),
        'post_type' => $postType,
        // Add other fields as needed
    ]);

    return redirect('/');
}


/**
 * Determine the post type based on content, image, and link.
 *
 * @param string|null $content
 * @param string|null $imagePath
 * @param string|null $link
 * @return string
 */
private function determinePostType($content, $imagePath, $link)
{
    if (!empty($content) && !empty($imagePath) && empty($link)) {
        return 'image-text';
    } elseif (!empty($content) && empty($imagePath) && empty($link)) {
        return 'text';
    } elseif (empty($content) && !empty($imagePath) && empty($link)) {
        return 'photo';
    } elseif (empty($content) && empty($imagePath) && !empty($link)) {
        return 'link';
    } else {
        // Default to 'text' if no content, image, or link
        return 'text';
    }
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validation logic
    $post->update([
        'content' => $request->input('content'),
        // Update other fields as needed
    ]);

    return redirect()->route('user.profile', ['user' => auth()->user()]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post->delete();
    return redirect()->route('user.profile', ['user' => auth()->user()]);
    }



    public function like(Request $request, Post $post)
    {
        $user = auth()->user(); // Get the authenticated user
        $like = like::where('post_id', $post->id)->where('user_id', $user->id)->first();
        
        if ($like) {
            // User already liked the post, so remove the like
            $like->delete();
        } else {
            // User has not liked the post, so add a like
            $like = new like();
            $like->user_id = $user->id;
            $like->post_id = $post->id;
            $like->reaction = 'like'; // or any default value
            $like->save();
        }

            $likesCount = 0;
        if ($post->likes) {
            $likesCount = $post->likes->count();
        }

        return response()->json(['success' => true, 'likes' => $likesCount]);
        }
}
