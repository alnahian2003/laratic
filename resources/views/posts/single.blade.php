@extends('posts/template')

@section('posts')
    <h1 class="text-5xl font-extrabold pb-5 text-transparent bg-clip-text bg-gradient-to-l from-sky-600 to-success border-b border-b-white/10">Latest Posts</h1>

    <section id="posts">
        @forelse ($posts as $post)
            <!-- Post -->
            <article class="post my-10 border-b border-b-white/20
            ">
                <a href="#">
                    <h2 class="text-secondary-content hover:text-success text-2xl font-bold mb-4">{{str()->limit($post->title, 60)}}</h2>
                </a>

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
                </div>

                <!-- Post Excerpt -->
                <p class="post-content text-neutral-content my-5">
                    {{str()->words($post->body, 40)}}
                </p>
    
                <div class="cta mb-8 text-secondary-content flex flex-row justify-between">
                    <div class="tags flex flex-row gap-3">
                        <a href="#web" class="tag"><span class="text-success">#</span>Web</a>
                        
                        <a href="#design" class="tag"><span class="text-success">#</span>Design</a>
                    </div>
                    <a href="{{route('show', $post->id)}}" class="text-success read_more flex flex-row flex-grow-0 gap-2 align-middle hover:underline">Read more 
                        <span class="arrow">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-arrow-right w-6 h-6" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                            </svg>
                        </span>
                    </a>
                </div>
            </article>
        @empty
        <h1 class="text-5xl font-extrabold pb-5 text-transparent bg-clip-text bg-gradient-to-l from-sky-600 to-success border-b border-b-white/10">No Post Available</h1>
        @endforelse
            
                <a href="#">
                    <h2 class="text-secondary-content hover:text-success text-2xl font-bold mb-4">Post Title Max 60 Charecter</h2>
                </a>

                <!-- Metadata -->
                <div class="metadata text-secondary-content flex flex-wrap gap-6">
                    <!-- Date -->
                    <small class="date flex gap-1">
                        <span class="clock">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                              </svg>    
                        </span>    
                        25 Minutes ago
                    </small>

                    <!-- Author -->
                    <a href="#" class="hover:text-success hover:transition-all">
                        <small class="date flex gap-1">
                            <span class="person">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                  </svg> 
                            </span>    
                            Al Nahian
                        </small>
                    </a>
                </div>

                <!-- Post Excerpt -->
                <p class="post-content text-neutral-content my-5">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Error hic porro et tenetur adipisci sunt illo veniam cumque, repellendus sequi. Error hic porro et tenetur adipisci sunt illo veniam cumque, repellendus sequi.
                </p>
    
                <div class="cta mb-8 text-secondary-content flex flex-row justify-between">
                    <div class="tags flex flex-row gap-3">
                        <a href="#web" class="tag"><span class="text-success">#</span>Web</a>
                        
                        <a href="#design" class="tag"><span class="text-success">#</span>Design</a>
                    </div>
                    <a href="#" class="text-success read_more flex flex-row flex-grow-0 gap-2 align-middle hover:underline">Read more 
                        <span class="arrow">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-arrow-right w-6 h-6" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                            </svg>
                        </span>
                    </a>
                </div>
            
    </section>
@endsection