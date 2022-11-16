@extends('posts/template')
@section('posts')
    <section id="post">
        <!-- Post -->
        <article class="post my-10 border-b border-b-white/20">
            @auth
                @canany(['update-post', 'delete-post'], $post)
                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-outline">Edit Post</a>

                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-danger btn-outline ml-2">Delete Post</a>
                @endcanany
            @endauth

            <h1
                class="text-2xl md:text-4xl font-extrabold pb-5 text-transparent bg-clip-text bg-gradient-to-l from-sky-600 to-success border-b mb-5 border-b-white/10 break-words leading-normal">
                {{ $post->title }}</h1>

            <!-- Metadata -->
            <div class="metadata text-secondary-content flex flex-wrap gap-6">
                <!-- Date -->
                <small class="date flex gap-1">
                    <span class="clock">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </span>
                    {{ $post->created_at->diffForHumans() }}
                </small>

                <!-- Author -->
                <a href="#" class="hover:text-success hover:transition-all">
                    <small class="date flex gap-1">
                        <span class="person">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" class="bi bi-person"
                                viewBox="0 0 16 16">
                                <path
                                    d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                            </svg>
                        </span>
                        {{ $post->user->username }}
                    </small>
                </a>

                <x-total-views :views="$post->views" />

                {{-- Tags --}}
                <div class="cta mb-8 text-secondary-content flex flex-row justify-between">
                    <div class="tags flex flex-row gap-3">
                        @foreach ($post->tags as $tag)
                            <small><a href="#{{ $tag->name }}" class="tag"><span
                                        class="text-success">#</span>{{ $tag->name }}</a></small>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Post Cover Image (Only if exists) --}}
            @if ($post->image !== null && file_exists(public_path('storage/' . $post->image->url)))
                <img class="max-w-full mx-auto rounded-lg object-cover" src="{{ asset('storage/' . $post->image->url) }}"
                    alt="Post By {{ $post->user->name }}" loading="lazy">
            @elseif($post->image !== null)
                <img class="max-w-full mx-auto rounded-lg object-cover" src="{{ $post->image->url }}"
                    alt="Post By {{ $post->user->name }}" loading="lazy">
            @endif

            <!-- Post Content -->
            <p class="post-content text-neutral-content mt-3 leading-loose">
                {{ $post->body }}
            </p>
        </article>
    </section>


    @auth
        <section id="comments">
            <h1 class="divider text-2xl">Leave a Comment</h1>


            <!-- comment form -->
            <x-comment-form :post_id="$post->id" />

            @forelse ($post->comments as $comment)
                <article class="post my-5 border-b border-b-white/20 p-3 space-y-3">
                    <img alt="..."
                        src="https://eu.ui-avatars.com/api/?name={{ $comment->user->username }}&format=svg&background=random&size=60"
                        class="shadow-xl rounded-full h-auto align-middle border-none max-w-150-px">
                    <strong>{{ $comment->user->username }}</strong>
                    <p>{{ $comment->body }}</p>
                </article>
            @empty
                <p class="text-success text-center font-bold">Be the first one to comment on this post.</p>
            @endforelse
        </section>
    @endauth

    @guest
        <p class="text-success text-center font-bold"><a class="underline" href="{{ route('auth.login') }}">Login</a> to
            comment on this post.
        </p>
    @endguest
@endsection
