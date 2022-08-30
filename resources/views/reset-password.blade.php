@extends('posts/template')

@section('account')  
<h1 class="text-center text-4xl text-white font-bold mb-10">Give a New Password</h1>  
{{-- Modal Form --}}
<form action="{{route('password.update')}}" method="post">
    @csrf
    <input type="hidden" name="token" value="{{$token}}">

    {{-- email --}}
    <label
    class="block mt mb-2 text-sm font-medium"
    for="username">Your Email Address</label>

    <input type="email"
    name="email"
    id="email"
    placeholder="example@mail.com"
    class="input input-bordered w-full focus:border-green-500 mb-2 @error('email') input-error @enderror"
    value="{{request('email')}}"/>

    @error ('email')
    <span class="label-text-alt text-error">{{$message}}</span>
    @enderror

    {{-- Password --}}
    <label
    class="block mt-4 mb-2 text-sm font-medium"
    for="password">Password</label>

    <input type="password"
    name="password"
    id="password"
    placeholder="What's your new password?"
    class="input input-bordered w-full focus:border-green-500 mb-2 @error('password') input-error @enderror"/>

    @error ('password')
    <span class="label-text-alt text-error">{{$message}}</span>
    @enderror


    {{-- Confirm Password --}}
    <label
    class="block mt-4 mb-2 text-sm font-medium"
    for="password">Confirm Password</label>

    <input type="password"
    name="password_confirmation"
    id="password_confirmation"
    placeholder="What's your password again?"
    class="input input-bordered w-full focus:border-green-500 mb-2 @error('password_confirmation') input-error @enderror"
    />

    @error ('password_confirmation')
    <span class="label-text-alt text-error">{{$message}}</span>
    @enderror

    <br>
    <button type="submit" class="btn font-bold bg-gradient-to-l from-sky-600 to-success text-white bottom-0 mt-4">Reset Password 😙</button>
</form>
@endsection