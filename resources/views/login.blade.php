@extends('posts/template')

@section('account')  
<h1 class="text-center text-4xl text-white font-bold mb-10">Login to Your Account</h1>  
{{-- Modal Form --}}
<form action="{{route('auth.login')}}" method="post">
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

    {{-- username --}}
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

    <div class="flex items-center my-3">
        <label class="label cursor-pointer" for="remember_me">
            <input type="checkbox" name="remember_me" class="checkbox" id="remember_me" />
            <span class="label-text ml-3">Remember me?
        </label>
    </div>

    <br>
    <button type="submit" class="btn font-bold bg-gradient-to-l from-sky-600 to-success text-white bottom-0">Let Me In 😙</button>
</form>
@endsection