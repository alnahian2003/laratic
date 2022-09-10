@extends('posts/template')

@section('create')
    <h3 class="text-2xl font-bold mb-5">Edit Your Post</h3>

    {{-- Display All Errors --}}
    @if ($errors->any())
        <div class="bg-red-500 my-5 p-8 rounded-md text-white">
            <p class="text-xl">Errors:</p>
            @foreach ($errors->all() as $error)
                • {{$error}} <br>
            @endforeach
        </div>
    @endif

    {{-- Edit Post FORM --}}
    <form action="{{route('posts.update', $post->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Post Title --}}
        <label class="block mt mb-2 text-sm font-medium" for="title">Update Post Title</label>
        <input type="text" name="title" id="title" placeholder="Edit post title" class="input input-bordered w-full focus:border-green-500 mb-2 @error('title') input-error @enderror" value="{{old('title') ?? $post->title}}"/>

        @error ('title')
        <span class="label-text-alt text-error">{{$message}}</span>
        @enderror

        {{-- Post Content --}}
        <label class="block mt-5 mb-2 text-sm font-medium" for="body">Update Post Details</label>
        <textarea class="textarea textarea-bordered w-full focus:border-green-500 @error('body') textarea-error @enderror" id="body" rows="5" name="body" placeholder="Write post details">{{old('body') ?? $post->body}}</textarea>

        @error ('body')
        <span class="label-text-alt text-error">{{$message}}</span>
        @enderror

        {{-- Post Cover Image --}}
        <label class="block mt-5 mb-2 text-sm font-medium" for="file_input">Update Cover Image</label>

        {{-- Post Cover Image (Only if exists) --}}
        @if ($post->cover !== null && file_exists(public_path('storage/'.$post->cover)))
            <img class="my-10 max-w-full mx-auto rounded-lg object-cover" src="{{asset('storage/'.$post->cover)}}" alt="Post By {{$post->user->name}}" loading="lazy">

        @elseif($post->cover !== null)
            <img class="my-10 max-w-full mx-auto rounded-lg object-cover" src="{{$post->cover}}" alt="Post By {{$post->user->name}}" loading="lazy">
        @endif

        <input class="block w-full p-3 text-sm text-gray-900 rounded-lg border cursor-pointer focus:outline-none bg-gray-700 border-gray-600 @error('cover') border-error @enderror placeholder-gray-400" id="file_input" name="cover" type="file">
        <p class="mt-1 text-sm" id="file_input_help">PNG, JPG or GIF (MAX 10MB).</p>

        @error ('cover')
        <span class="label-text-alt text-error">{{$message}}</span>
        @enderror

        <br>
        <button type="submit" class="btn font-extrabold bg-gradient-to-l from-sky-600 to-success text-white mt-4 bottom-0">Crack it 🤪</button>
    </form>
@endsection
