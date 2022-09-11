<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{

    use SoftDeletes;

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

        /* We can use the insert() method to store as well */
        //        $post = new Post;
        //        $post->title = $valid['title'];
        //        $post->body = $valid['body'];
        //        $post->user_id = $valid['user_id'];
        //        if ($post->save()) {
        //            return redirect('/');
        //        }

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
        // Increment the post view
        $post->update([$post->views++]);

        return view('posts.single', [
            'title' => $post->title,
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function edit(Post $post)
    {
        // if (!Gate::allows('delete-post', $post)) {
        //     abort(403);
        // }
        // Gate::allowIf(fn ($user) => $user->id === $post->user_id); //inline gate
        // return view('register', ['title' => 'Edit Post', 'post' => $post]); // for now {testing purpose}

        if ($this->authorize('update', $post)) {
            return view('posts.edit', [
                'title' => 'Edit Post',
                'post' => $post,
            ]);
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
     * @param Request $request
     * @param Post $post
     * @return RedirectResponse
     */
    public function update(Request $request, Post $post)
    {
        if ($post->user_id === auth()->user()->id) {
            $validator = Validator::make(
                $request->all(),
                [
                    'title' => 'required|max:255',
                    'body' => 'required',
                    'cover' => 'image|max:10240|mimes:jpg,png,gif',
                ]
            );

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            // get the fresh validated input
            $valid = $validator->validated();
            // Upload logo to file
            if ($request->hasFile('cover')) {
                $valid['cover'] = $request->file('cover')->store('cover', 'public');
            }

            if (Post::where('id', $post->id)->update($valid)) {
                // redirect to the updated post
                return to_route('posts.show', $post->id);
            }
        }

        return to_route('posts.index');
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
