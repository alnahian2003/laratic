<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');

        // $this->authorizeResource(Post::class, 'post');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->paginate(10)->withQueryString();

        return view('posts.all_posts', [
            'posts' => $posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create_post', [
            'title' => 'Create New Post'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StorePostRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $valid = $request->validated();

        // Upload logo to file
        if ($request->hasFile('cover')) {
            $valid['cover'] = $request->file('cover')->store('cover', 'public');
        }

        // Set the user_id column to the current auth user id
        $valid['user_id'] = auth()->id();

        if (Post::create($valid)) {
            return redirect('/');
        }

        return back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.single', [
            'title' => $post->title,
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Post $post)
    {
        // if (!Gate::allows('delete-post', $post)) {
        //     abort(403);
        // }
        // Gate::allowIf(fn ($user) => $user->id === $post->user_id); //inline gate
        // return view('register', ['title' => 'Edit Post', 'post' => $post]); // for now {testing purpose}

        if ($this->authorize('update', $post)) {
            return "You can edit this post";
        }
        // if ($request->user()->cannot('update', $post)) {
        //     abort(403);
        // } else {
        //     return 'yes you can edit this post';
        // }

        // $response = Gate::authorize('update', $post);
        // if ($response->allowed()) {
        //     return "You can edit this post";
        // } else {
        //     return $response->message();
        // }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
