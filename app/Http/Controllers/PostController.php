<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->get();
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
    if (!empty($content) && !empty($imagePath)) {
        return 'image-text';
    } elseif (!empty($content)) {
        return 'text';
    } elseif (!empty($imagePath)) {
        return 'photo';
    } elseif (!empty($link)) {
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
