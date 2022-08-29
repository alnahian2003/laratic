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

    {{-- Login/Register --}}
    @hasSection ('account')
        <div class="container rounded-xl bg-opacity-80 backdrop-blur-2xl max-w-lg my-10 mx-auto p-10 bg-neutral">
            @yield('account')
        </div>
    @endif

    {{-- Hide the create post modal if the current page is route('create') --}}
    @if (!request()->routeIs('create'))
    <input type="checkbox" id="create-post-modal" class="modal-toggle" />
    <div class="modal">
      <div class="modal-box w-6/12 max-w-5xl relative">
        <label for="create-post-modal" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
        
        <h3 class="text-2xl font-bold mb-5">Write a Post Instantly ✨</h3>
        @include('components/create_post_form')
    @endif

  </div>
</div>


@include('components/bottom_navbar')
</body>
</html>