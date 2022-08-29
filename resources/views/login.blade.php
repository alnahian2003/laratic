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
    placeholder="Provide your name"
    class="input input-bordered w-full focus:border-green-500 mb-2 @error('username') input-error @enderror"
    value="{{old('username')}}"/>

    @error ('username')
    <span class="label-text-alt text-error">{{$message}}</span>
    @enderror

    {{-- username --}}
    <label
    class="block mt mb-2 text-sm font-medium"
    for="username">Username</label>

    <input type="text"
    name="username"
    id="username"
    placeholder="Provide your name"
    class="input input-bordered w-full focus:border-green-500 mb-2 @error('username') input-error @enderror"
    value="{{old('username')}}"/>

    @error ('username')
    <span class="label-text-alt text-error">{{$message}}</span>
    @enderror

    <div class="flex items-center my-3">
        <label class="label cursor-pointer" for="terms">
            <input type="checkbox" name="terms" class="checkbox" id="terms" />
            <span class="label-text ml-3">Remember me?
        </label>
    </div>

    <br>
    <button type="submit" class="btn font-extrabold bg-gradient-to-l from-sky-600 to-success text-white bottom-0">Let's Do It 🎉</button>
</form>
@endsection