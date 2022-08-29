<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('login', [
            'title' => 'Login'
        ]);
    }

    /**
     * Attempt to login a user
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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
            return redirect()->intended();
        }

        return back()->withErrors([
            'login_error_message' => "Something wasn't right! Please try again."
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->only(['username', 'password', 'password_confirmation']), [
            'username' => 'required|unique:users,username|min:3|max:50|alpha',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return to_route('register')->withErrors($validator)->withInput()->exceptInput('password', 'password_confirmation');
        }

        // Get the validated inputs
        $validated = $validator->safe()->only(['username', 'password']);
        $validated['password'] = bcrypt($validated['password']); // hash the passsword

        // Create the user with validated values
        $user = User::create($validated);

        // Login the registered user
        auth()->login($user, true);

        return redirect()->intended();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
