@extends('posts/template')

@section('create')
<h3 class="text-2xl font-bold mb-5">Write a Post Instantly ✨</h3>
{{-- Modal Form --}}
<form action="{{route('store')}}" method="post" enctype="multipart/form-data">
    @csrf

    {{-- Post Title --}}
    <label class="block mt mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="file_input">Post Title</label>
    <input type="text" name="title" placeholder="Give a post title" class="input input-bordered w-full mb-2 @error('title') input-error @enderror" value="{{old('title')}}"/>

    @error ('title')
    <span class="label-text-alt text-error">{{$message}}</span>
    @enderror

    {{-- Post Content --}}
    <label class="block mt-5 mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="file_input">Post Details</label>
    <textarea class="textarea textarea-bordered w-full @error('body') textarea-error @enderror"" name="body" placeholder="Write post details" value="{{old('body')}}"></textarea>

    @error ('body')
    <span class="label-text-alt text-error">{{$message}}</span>
    @enderror

    {{-- Post Cover Image --}}
    <label class="block mt-5 mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="file_input">Upload Cover Image</label>

    <input class="block w-full p-3 text-sm text-gray-900 rounded-lg border cursor-pointer dark:text-gray-400 focus:outline-none bg-gray-700 border-gray-600 @error('cover') border-error @enderror placeholder-gray-400" id="file_input" name="cover" type="file">
    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPG or GIF (MAX 10MB).</p>

    @error ('cover')
    <span class="label-text-alt text-error">{{$message}}</span>
    @enderror

    <br>
    <button type="submit" class="btn font-extrabold bg-gradient-to-l from-sky-600 to-success text-white mt-3 bottom-0 w-3/12">Let's Do It 🎉</button>
</form>
@endsection
