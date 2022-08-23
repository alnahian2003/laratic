@extends('posts/template')

@section('create')
    <h3 class="text-2xl font-bold mb-5">Write a Post Instantly ✨</h3>

    {{-- Displaying a single error --}}
    @if ($errors->has('title'))
    <div class="bg-red-100 mb-5 px-8 py-5 rounded-md text-red-600">
        <p class="text-lg font-semibold">
            {{-- Retrieving The First Error Message For A Field --}}
            • {{$errors->first('title')}}<br/>
        </p>
    </div>
    @endif

    {{-- Display All Errors --}}
    @if ($errors->any())
        <div class="bg-red-500 my-5 p-8 rounded-md text-white">
            <p class="text-xl">Errors:</p>
            @foreach ($errors->all() as $error)
                • {{$error}} <br>
            @endforeach
        </div>
    @endif

    {{-- Create a New Post FORM --}}
    @include('components/create_post_form')
@endsection
