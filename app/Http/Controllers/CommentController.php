<?php

namespace App\Http\Controllers;


use App\Models\comment;
use App\Models\Post;
use Illuminate\Http\Request;


class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Post $post)
    {
        $comment = new Comment();
        $comment->user_id = auth()->id();
        $comment->post_id = $post->id;
        $comment->comment_text = $request->comment;
        $comment->save();
    
        // Fetch the user name for the response
        $userName = $comment->user->name;
    
        return response()->json(['success' => true, 'commentText' => $comment->comment_text, 'userName' => $userName, 'userId' => $comment->user_id]);
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

    public function loadComments(Post $post) {
        $comments = $post->comments()->with('user')->get()->map(function ($comment) {
            return [
                'text' => $comment->comment_text,
                'userName' => $comment->user->name,
                'userId' => $comment->user->id,
            ];
        });
    
        return response()->json(['comments' => $comments]);
    }
    
}
