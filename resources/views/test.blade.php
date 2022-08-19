@extends('template')

@section('title', "Main Page")

@section('content')

<h1 class="text-8xl font-bold text-slate-300 underline mb-10">
    Hello <span class="text-indigo-500 dark:hover:text-teal-200">tailwind!</span>
</h1>
    <button onclick="location.href='{{route('test.create')}}'" class="btn-blue mb-5">Upload a File</button>
    <hr>
    <br>

    @forelse ($testArr as $item)

    @if ($loop->first)
    <button class="btn-blue m-2">First Button</button>
    @endif
    <button class="btn-green m-2">Button {{$item}}</button>
    @if ($loop->last)
    <button class="btn-blue m-2">Last Button</button>
    @endif
    
    @empty
        No Buttons Available
    @endforelse

    <br>
    <br>
    <hr>
    <br>

@unless ($thisYear === 2023)
<h1>This is not 2023</h1>   
@endunless

@production
<br>
<br>
<hr>
<br>
<br>
this is on production   
@endproduction
<br>
<hr>
<br>
@env('local')
this is a local environment
@endenv

<br>
<br>
<hr>
<br>

@php
    $isAdmin = true;
    $isSubscriber = !false;
@endphp

<button @class([
    "btn-blue hover:transition",
    "bg-teal-500 hover:bg-slate-600" => $isAdmin,
    "bg-red-700" => $isSubscriber
])>
@if($isAdmin)
Admin Dashboard
@else 
Subscriber Dashboard
@endif
</button>


@endsection