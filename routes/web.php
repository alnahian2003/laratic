<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource("posts", PostController::class);
Route::resource('profile', ProfileController::class);

// Restoring User's Post
Route::get('archive', [ProfileController::class, 'archive'])->name('posts.archive');
Route::post('restore/{id}', [PostController::class, 'restore'])->name('posts.restore');

// Force Deleting User's Post
Route::post('force/{id}', [PostController::class, 'force'])->name('posts.force_delete');

// Force Deleting User's Post
Route::post('clone/{id}', [PostController::class, 'clone'])->name('posts.clone');

Route::controller(UserController::class)->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', 'index')->name('login');
        Route::post('login', 'login')->name('auth.login');

        Route::get('register', 'create')->name('register');
        Route::post('register', 'store')->name('auth.register');
    });

    Route::get('logout', 'logout');
});

// Resetting the forgot password
Route::get('/forgot-password', function () {
    return view('forgot-password')->with('title', 'Reset Your Password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function ($token) {
    return view('reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:6|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();
        }
    );

    return $status === Password::PASSWORD_RESET
        ? redirect()->route('login')->with('status', __($status))
        : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');




Route::get('/', [PostController::class, 'index']);


Route::get('db', function () {

    // foreach (App\Models\Post::cursor() as $post) {
    //     echo "<pre>";
    //     print_r($post);
    //     echo "</pre>";
    // }

    // Retrieve a model by its primary key...
    // return App\Models\User::find(151);

    // Retrieve the first model matching the query constraints...
    // return App\Models\User::where('username', 'alnahian2003')->first();


    // Alternative to retrieving the first model matching the query constraints...
    // return App\Models\User::firstWhere('username', request('username'));

    // return App\Models\Post::findOr(10, fn () => abort(404));

    // return App\Models\User::findOr(1, ['username', 'name', 'created_at'], fn () => abort(404));

    // Get the first post from db where it has more than 9k views
    // return App\Models\Post::where('views', '>', 9000)->firstOr(fn () => abort(404));

    // Throw an exception if a model is not found
    // return App\Models\Post::findOrFail(1000);

    // return App\Models\User::firstOrFail(['username', 'email']);

    // Retrieving Or Creating Models
    // return App\Models\User::firstOrCreate(
    //     ['username' => 'bond007'],
    //     [
    //         'name' => 'James Bond',
    //         'email' => 'bond007@cia.com',
    //         'password' => bcrypt('bond007')
    //     ]
    // );

    // $user = App\Models\User::firstOrNew(
    //     ['username' => 'feluda'],
    //     [
    //         'name' => 'Felu Mittir',
    //         'email' => 'feluda@raw.com',
    //         'password' => bcrypt('felumittir')
    //     ]
    // );

    // $user->save();

    // return $user;

    // ### Retrieving Aggregates
    return App\Models\Post::latest()
        ->limit(10)
        ->sum('views'); // get total views of the last 10 posts

    // ###################
    // return App\Models\Post::addSelect(["title" => App\Models\User::select('name')])->whereColumn('post_id', 'users.id')->limit(1)->dd();


    // return App\Models\Post::simplePaginate(5);
    // return DB::table('posts')->get()->dd();
});


Route::get('search/{search?}', function ($search = '') {
    if ($search == '') {
        return App\Models\User::limit(10)
            ->latest()
            ->get();
    }

    return App\Models\User::where('username', $search)
        ->orWhere('id', $search)
        ->latest()
        ->firstOrFail();
});

Route::get('delete', function () {
    // Deleting An Existing Model By Its Primary Key
    if (\App\Models\Post::destroy(collect([1, 2, 3]))) {
        return "Posts Deleted";
    }
    return "Posts Doesn't Exists";
});


// Route::get('details', function () {
// Get all Comments of a specific post
// $post = App\Models\Post::findOrFail(160);
// dd($post->comments);

// Get all comments by a user
// $user = App\Models\User::findOrFail(757);
// dd($user->comments);

// Get post of a specific comment
// $post = App\Models\Comment::findOrFail(1);

// return $post->post;

// Get all comments
// return App\Models\Comment::all();


// Querying Belongs To Relationships
// $user = App\Models\User::findOrFail(700);
// return App\Models\Post::whereBelongsTo($user)->get();

// get all comments belongs to a post 
// return App\Models\Comment::whereBelongsTo($post)->get();
// });

// Route::get('eager', function () {
// $posts = App\Models\Post::has('comments')
//     ->with(['comments' => ['user']])
//     ->latest('id')
//     ->get();

// // return $posts[1]->comments[0]->user;

// foreach ($posts as $post) {
//     echo "<pre><code>";
//     // print_r($post);
//     foreach ($post->comments as $comment) {
//         print_r($comment);
//         print_r($comment->user);
//     }
//     echo "</code></pre>";
// };

// Eager Loading Specific Columns
// never forget to include the relevant foreign key
// return $users = App\Models\User::has('post')
//     ->with(['post:id,user_id,title,body', 'comments:id,user_id,post_id'])
//     ->latest('id')
//     ->get();


// Using Eager Loading Constraints
// return $posts = App\Models\Post::has('comments')
//     ->with([
//         'comments' => function ($query) {
//             $query->where('user_id', '>', 750)->orderBy('created_at', 'desc');
//         }

//     ])
//     ->latest('id')
//     ->get();

// print_r($posts);
// });


// Inserting & Updating Related Models
Route::get('playground', function () {
    // $post = App\Models\Post::findOrFail(183);

    // $comment = new App\Models\Comment;
    // $comment->body = "This article is awesome!";
    // $comment->user_id = 11;

    // // save the new comment with `user_id`
    // return $post->comments()->save($comment);

    // $post->comments()->saveMany([
    //     new App\Models\Comment([
    //         'body' => "I'm About to End This Man's Whole Career",
    //         'user_id' => 11
    //     ]),
    //     new App\Models\Comment([
    //         'body' => "Ah Buddy! Whatcha doin?",
    //         'user_id' => 12
    //     ])
    // ]);

    // $post->refresh();

    // return $post->comments;


    // Recursively Saving Models & Relationships
    // $post->comments[0]->body = 'Whaaaaaaaaaaaaaat!';

    // $post->comments[0]->user->name = 'Al Nahian Gazi';

    // return $post;


    // using the create() method... createMany() also works in the same way
    // return $post->comments()->create([
    //     'body' => 'Pretty New Wholesome Comment',
    //     'user_id' => 23
    // ]);



    // Attach, Detach, Sync, Toggle and more...
    // $user = App\Models\User::findOrFail(663);

    // Post id 116 of user 11
    // $post = App\Models\Post::findOrFail(117);

    // $post->user()->associate($user);
    // $post->user()->dissociate();
    // $post->save();

    // get all posts by the user
    // print_r($user->post);





    // ------ Aggregating Related Models ------

    // Counting total comments of all posts
    // return App\Models\Comment::count();

    // Counting total comments of a post
    // $posts = App\Models\Post::latest()->has('comments')->withCount('comments as count');
    // foreach ($posts as  $post) {
    //     echo "$post->id = $post->comments_count <br>";
    // };

    // this will work
    // echo "Post {$posts[20]->id} = Total Comments {$posts[20]->count} <br>";

    // this will also work... cool
    // return App\Models\Post::findOrFail(183)->comments->count();


    // other aggregate functions
    // return App\Models\Post::findOrFail(183)->withExists('user')->get();


    // ----- Querying Relationship Existence -----

    // Get all users those who have atleast 2 posts
    // $users = App\Models\User::has('post', '>=', 2)->get();

    // return $users;

    // nested has

    // get users those who have posts with comments
    // $posts = App\Models\Post::has('comments')->with('user')->withCount('comments')
    //     ->get();

    // print_r($posts);


    // Retrieve posts with at least one comment containing words like %a%...
    // $posts = App\Models\Post::whereHas('comments', function (Builder $query) {
    //     $query->where('body', 'like', '%a%');
    // })->get();

    // return ($posts);

    // Retrieve posts with at least five comments containing words like awe%...
    // return App\Models\Post::whereHas('comments', function (Builder $query) {
    //     $query->where('body', 'like', '%a%');
    // }, '>=', 5)->get();





    // Inline Relationship Existence Queries

    // return App\Models\Post::whereRelation('comments', 'deleted_at', null)->get();

    // return App\Models\Post::whereRelation('comments', 'user_id', 11)->get();


    // ----- Querying Relationship Absence -----


    // retrieve all blog posts that don't have any comments.
    // return App\Models\Post::doesntHave('comments')->withCount('comments')->get();

    // and the rests are as same as querying relationship existence




    // ----- Many To Many Relationships -----

    // get a user's roles
    // return $user = App\Models\User::findOrFail(11)->has('roles')->with('roles')->get();




    // ----- Polymorphic Relationships -----

    // One To One (Polymorphic)
    // return App\Models\User::find(11)->image;



    // Migrate all the current posts urls in the images table
    // $posts = App\Models\Post::where('cover', '!=', null)->get();
    // $data = [];
    // foreach ($posts as $post) {
    //     $data[] = [
    //         'id' => $post->id,
    //         'cover' => $post->cover
    //     ];
    // }
    // foreach ($data as $input) {
    //     App\Models\Image::insert([
    //         'url' => $input['cover'],
    //         'imageable_id' => $input['id'],
    //         'imageable_type' => 'App\Models\Post'
    //     ]);
    // }

    // return App\Models\Post::findOrfail(112)->image;

    return App\Models\Post::find(183)->tags;
});
