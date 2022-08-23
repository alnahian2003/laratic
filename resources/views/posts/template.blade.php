<!DOCTYPE html>
<html lang="en" class="bg-neutral-focus">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/js/app.js')
    <title>
        {{isset($title) ? $title ." | Laratic" : "Laratic Blog"}}</title>
</head>
<body>
    @hasSection ('posts')
        <div class="container rounded-xl bg-opacity-80 backdrop-blur-2xl max-w-5xl my-10 mx-auto p-10 bg-neutral" id="post_container">
            <div class="text-sm breadcrumbs">
                <ul>
                  <li><a href="{{route('index')}}">Home</a></li> 
                  <li><a href="{{route('create')}}">Create</a></li>
                </ul>
            </div>
            @yield('posts')
        </div>
    @endif

    {{-- Create Post --}}
    @hasSection ('create')
        <div class="container rounded-xl bg-opacity-80 backdrop-blur-2xl max-w-5xl my-10 mx-auto p-10 bg-neutral" id="create_post">
            @yield('create')
        </div>
    @endif

    {{-- Hide the create post modal if the current page is route('create') --}}
    @if (!request()->routeIs('create'))
    <input type="checkbox" id="create-post-modal" class="modal-toggle" />
    <div class="modal">
      <div class="modal-box w-6/12 max-w-5xl relative">
        <label for="create-post-modal" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
        
        <h3 class="text-2xl font-bold mb-5">Write a Post Instantly ✨</h3>
        {{-- Modal Form --}}
        <form action="{{route('store')}}" method="post" enctype="multipart/form-data">
            @csrf

            {{-- Post Title --}}
            <label class="block mt mb-2 text-sm font-medium" for="file_input">Post Title</label>
            <input type="text" name="title" placeholder="Give a post title" class="input input-bordered w-full mb-2 @error('title') input-error @enderror" value="{{old('title')}}"/>

            @error ('title')
            <span class="label-text-alt text-error">{{$message}}</span>
            @enderror

            {{-- Post Content --}}
            <label class="block mt-5 mb-2 text-sm font-medium" for="file_input">Post Details</label>
            <textarea class="textarea textarea-bordered w-full @error('body') textarea-error @enderror"" name="body" placeholder="Write post details" value="{{old('body')}}"></textarea>

            @error ('body')
            <span class="label-text-alt text-error">{{$message}}</span>
            @enderror

            {{-- Post Cover Image --}}
            <label class="block mt-5 mb-2 text-sm font-medium" for="file_input">Upload Cover Image</label>

            <input class="block w-full p-3 text-sm text-gray-900 rounded-lg border cursor-pointer dark:text-gray-400 focus:outline-none bg-gray-700 border-gray-600 @error('cover') border-error @enderror placeholder-gray-400" id="file_input" name="cover" type="file">
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPG or GIF (MAX 10MB).</p>

            @error ('cover')
            <span class="label-text-alt text-error">{{$message}}</span>
            @enderror

            <br>
            <button type="submit" class="btn font-extrabold bg-gradient-to-l from-sky-600 to-success text-white mt-3 bottom-0 w-3/12">Let's Do It 🎉</button>
        </form>
    @endif

  </div>
</div>



<!-- Primary Bottom Navigation -->
<div class="btm-nav bg-opacity-80 backdrop-blur">
    <button class="{{request()->routeIs('index') ? 'active bg-neutral bg-opacity-60' : ''}} hover:bg-base-300 hover:bg-opacity-50" onclick="window.location='{{route('index')}}'">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
      <span class="btm-nav-label">Home</span>
    </button>


    @if (!request()->routeIs('create'))
        {{-- Create Button With Modal --}}
    <button class="hover:bg-base-300 hover:bg-opacity-50">
        <label role="button" for="create-post-modal" class="w-full px-5">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="btm-nav-label">Create</span>
        </label>
    </button>
    @endif

    <button class="{{request()->routeIs('edit', 1) ? 'active bg-neutral bg-opacity-60' : ''}} hover:bg-base-300 hover:bg-opacity-50" onclick="window.location='{{route('edit', 1)}}'">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
          <span class="btm-nav-label">Profile</span>
        </button>
    
  </div>
<!-- Put this part before </body> tag -->
</body>
</html>