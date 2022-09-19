<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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


Route::get('details', function () {
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
});