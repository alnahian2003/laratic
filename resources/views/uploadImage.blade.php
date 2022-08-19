@extends('template')

@section('title')
@section('navbar')

@section('content')
<div class="container mx-auto text-center">
    <h1 class="text-5xl dark:text-slate-200 text-slate-700 font-bold hover:underline m-5">
        Upload an <span class="text-blue-500">awesome image!</span>
        </h1>
        
    <hr>

    <form class="flex items-center space-x-6 pt-40 py-10 justify-center" action="{{route('test.store')}}" method="POST" enctype="multipart/form-data">

        <label class="block">
            <input type="file" class="block w-full text-sm text-slate-500
            file:mr-4 file:py-2 file:px-4
            file:rounded-full file:border-0
            file:text-sm file:font-semibold
            file:bg-blue-50 file:text-blue-700
            hover:file:bg-blue-100
            " name="image"/>
        </label>

        @csrf

        <button class="btn-blue" type="submit">Upload Your Image</button>
        </form>

        <hr>

        @if (session('test'))
        <div class="bg-green-100 w-1/3 mx-auto my-10 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Holy smokes!</strong>
            <span class="block sm:inline">{{session('test')}}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span>
        </div>
    @endif

    </div>
@endsection