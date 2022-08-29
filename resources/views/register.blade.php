@extends('posts/template')

@section('account')  
<h1 class="text-center text-4xl text-white font-bold mb-10">Register New Account</h1>  
{{-- Modal Form --}}
<form action="{{route('auth.register')}}" method="post">
    @csrf

    {{-- username --}}
    <label
    class="block mt mb-2 text-sm font-medium"
    for="username">Username</label>

    <input type="text"
    name="username"
    id="username"
    placeholder="Provide your username"
    class="input input-bordered w-full focus:border-green-500 mb-2 @error('username') input-error @enderror"
    value="{{old('username')}}"/>

    @error ('username')
    <span class="label-text-alt text-error">{{$message}}</span>
    @enderror

    {{-- Password --}}
    <label
    class="block mt-4 mb-2 text-sm font-medium"
    for="password">Password</label>

    <input type="password"
    name="password"
    id="password"
    placeholder="What's your password?"
    class="input input-bordered w-full focus:border-green-500 mb-2 @error('password') input-error @enderror"
    value="{{old('password')}}"/>

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
    placeholder="What's your password?"
    class="input input-bordered w-full focus:border-green-500 mb-2 @error('password_confirmation') input-error @enderror"
    value="{{old('password_confirmation')}}"
    minlength="6"
    />

    @error ('password_confirmation')
    <span class="label-text-alt text-error">{{$message}}</span>
    @enderror

    <br>
    <button type="submit" class="btn font-bold bg-gradient-to-l mt-4 from-sky-600 to-success text-white bottom-0">Let's Proceed 😍</button>
</form>
@endsection