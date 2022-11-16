<?php

namespace App\Http\Controllers;

use App\Events\CommentCreated;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only(['store', 'update', 'destroy']);

        $this->authorizeResource(Comment::class, 'comment');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->user()->cannot('create', Comment::class)) {
            abort(403);
        }

        // Create the comment
        $validated = validator($request->only(['body', 'post_id']), ['body' => 'required|string', 'post_id' => 'required|numeric'], ['body' => 'comment'])->validated();

        $validated['user_id'] = auth()->user()->id;

        if ($comment = Comment::create($validated)) {

            CommentCreated::dispatch($comment); // fire the event

            return back();
        };

        return back()->withErrors($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Comment $comment)
    // {
    //     //
    // }
}
