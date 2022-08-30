@extends('posts/template')

@section('account')  
<h1 class="text-center text-4xl text-white font-bold mb-10">Reset Password</h1>  
{{-- Modal Form --}}
<form action="{{route('password.email')}}" method="post">
    @csrf

    {{-- email --}}
    <label
    class="block mt mb-2 text-sm font-medium"
    for="username">Email Where We Can Send A Password Reset Link</label>

    <input type="email"
    name="email"
    id="email"
    placeholder="example@mail.com"
    class="input input-bordered w-full focus:border-green-500 mb-2 @error('email') input-error @enderror"
    value="{{old('email')}}"/>

    @error ('email')
    <span class="label-text-alt text-error">{{$message}}</span>
    @enderror

    <br>
    <button type="submit" class="btn font-bold bg-gradient-to-l from-sky-600 to-success text-white bottom-0 mt-4">Send Me The Reset Link 😙</button>
</form>
@endsection