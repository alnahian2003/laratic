@extends('posts/template')

@section('posts')
    <section id="post">
            <!-- Post -->
            <article class="post my-10 border-b border-b-white/20">
                <h1 class="text-5xl font-extrabold pb-5 text-transparent bg-clip-text bg-gradient-to-l from-sky-600 to-success border-b mb-5 border-b-white/10 break-words">{{$post->title}}</h1>

                <!-- Metadata -->
                <div class="metadata text-secondary-content flex flex-wrap gap-6">
                    <!-- Date -->
                    <small class="date flex gap-1">
                        <span class="clock">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                              </svg>    
                        </span>    
                        {{$post->created_at->diffForHumans()}}
                    </small>

                    <!-- Author -->
                    <a href="#" class="hover:text-success hover:transition-all">
                        <small class="date flex gap-1">
                            <span class="person">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                  </svg> 
                            </span>    
                            {{$post->user->username}}
                        </small>
                    </a>

                    <x-total-views :views="$post->views"/>

                    {{-- Tags --}}
                    <div class="cta mb-8 text-secondary-content flex flex-row justify-between">
                        <div class="tags flex flex-row gap-3">
                            <small><a href="#web" class="tag"><span class="text-success">#</span>Web</a></small>
                            
                            <small><a href="#design" class="tag"><span class="text-success">#</span>Design</a></small>
                        </div>
                    </div>
                </div>

                {{-- Post Cover Image (Only if exists) --}}
                @if ($post->cover !== null)
                    <img class="max-w-full w-full rounded-lg object-cover" src="{{asset('storage/'.$post->cover)}}" alt="" srcset="">
                @endif

                <!-- Post Content -->
                <p class="post-content text-neutral-content my-3">
                    {{ $post->body }}
                </p>
            </article>
    </section>
@endsection