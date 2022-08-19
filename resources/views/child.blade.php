@extends('app')

@section('title', "Inherited Layout")

@section('sidebar')
@parent
<h1 class="text-4xl">Sidebar Content</h1>
@endsection

@section('content')
    <article class="prose">
        <h2 class="text-3xl">This is the main content area</h2>
        <p class="max-w-5xl leading-7">Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa magni dolorum unde quos fuga, quod atque repudiandae delectus itaque exercitationem similique magnam ducimus alias, aspernatur fugiat excepturi placeat porro laudantium?</p>
    
        <button class="btn btn-primary">DaisyUI Button</button>
    </article>

@endsection

@section('footer')
@parent

<h1 class="text-2xl">Footer Content Here</h1>
    @forelse ($testArr as $item)

        @if ($loop->first)
            <button class="btn btn-secondary m-2">First Button</button>
        @endif

        <button class="btn btn-primary m-2">Button {{$item}}</button>

        @if ($loop->last)
        <div class="avatar online placeholder">
            <div class="bg-neutral-focus text-neutral-content rounded-full w-16">
              <span class="text-xl">JO</span>
            </div>
          </div> 
            <button class="btn btn-success m-2">Last Button</button>
        @endif

    @empty
        No Buttons Available
    @endforelse
    <div class="mockup-code">
        <pre data-prefix="$"><code>npm i daisyui</code></pre>
      </div>
@endsection

@push('scripts')
    @vite('resources/js/app.js')
@endpush