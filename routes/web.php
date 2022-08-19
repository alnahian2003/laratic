<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::resource("/", PostController::class);


Route::view('child', 'child');

Route::resource("test", MainController::class);


Route::get('sestest', function (Request $req) {
    // Setting the session with key value pairs
    session(['test' => 'Al Nahian']);
    $req->session()->put(['api_key' => ['bPOFtISzRPmcHZnmmlHh']]);

    // // Check if a session item exist
    // if (session()->has("test")) {
    //     return session('test');
    // }

    // Check if a session itom is not present
    if (session()->missing("api_key")) {
        return "Session Key Missing";
    }

    session()->push('api_key', 'newDatabutInRandomOrder'); // add a new item to the array
    $req->session()->pull('api_key'); // deletes the key

    session()->flash('message', "Wanna hear a joke? 😜");

    // session()->invalidate();
    session()->regenerate();

    // Retrieving all session data
    return $req->session()->all();

    // Getting the session value
    return session('test');
})->block();

Route::get("testy", function () {
    if (session()->exists('message')) {
        return session("message");
    } else {
        abort(404);
    }
});
