<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('login', [
            'title' => 'Login'
        ]);
    }

    /**
     * Attempt to log in a user
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->only(['username', 'password']), [
            'username' => 'required|min:3|max:50',
            'password' => 'required|min:4',
        ]);

        if ($validator->fails()) {
            return to_route('login')->withErrors($validator)->withInput()->exceptInput('password');
        }

        // Get the validated inputs
        $validated = $validator->safe()->only(['username', 'password']);

        $remember = request()->has('remember_me') ? true : false;

        // Attempt the user to login
        if (auth()->attempt($validated, $remember)) {
            session()->regenerate();

            Log::channel('users')->info("A User Just Logged In", [$validated['username']]);

            return redirect()->intended();
        }

        return back()->withErrors([
            'login_error_message' => "Something wasn't right! Please try again."
        ])->exceptInput('password');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('register', [
            'title' => 'Create a New Account'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->only(['username', 'password', 'password_confirmation']), [
            'username' => 'required|unique:users,username|min:3|max:50',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return to_route('register')->withErrors($validator)->withInput()->exceptInput('password', 'password_confirmation');
        }

        // Get the validated inputs
        $validated = $validator->safe()->only(['username', 'password']);
        $validated['password'] = bcrypt($validated['password']); // hash the password

        // Generate a Unique Name for the user
        $validated['name'] = uniqid('User_');

        // Create the user with validated values
        $user = User::create($validated);

        // Login the registered user
        auth()->login($user, true);

        Log::channel('users')->info('A New User Has Been Registered', [$validated['username']]);

        return redirect()->intended();
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return Application|Redirector|RedirectResponse
     */
    public function logout()
    {
        if (auth()->check()) {
            auth()->logout();
            session()->flush();
            session()->invalidate();
            session()->regenerateToken();

            Log::channel('users')->info("A User Just Logged Out");
        }

        return redirect('/');
    }
}
