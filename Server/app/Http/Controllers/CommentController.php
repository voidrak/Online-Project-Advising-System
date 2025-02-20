<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
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
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }

    public function getCommentsByProject($projectId)
    {
        $comments = Comment::where('project_id', $projectId)->with('user')->get();
        return response()->json($comments);
    }

    public function addComment(Request $request, $projectId)
    {
        $validatedData = $request->validate([
            'content' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);

        $comment = new Comment();
        $comment->content = $validatedData['content'];
        $comment->user_id = $validatedData['user_id'];
        $comment->project_id = $projectId;
        $comment->save();

        return response()->json($comment, 201);
    }
}
