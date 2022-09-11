<!-- Primary Bottom Navigation -->
<div class="btm-nav bg-opacity-80 backdrop-blur">
    <button class="{{request()->routeIs('posts.index') ? 'active bg-neutral bg-opacity-60' : ''}} hover:bg-base-300 hover:bg-opacity-50" onclick="window.location='{{route('posts.index')}}'">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
      <span class="btm-nav-label">Home</span>
    </button>


    @auth
        @if (!request()->routeIs('posts.create'))
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
    @endauth

      @if (!request()->routeIs('profile.index'))
      <button class="hover:bg-base-300 hover:bg-opacity-50" onclick="window.location='{{route('profile.index')}}'">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
      <span class="btm-nav-label">Profile</span>
    </button>
      @endif
    
    
  </div>
<!-- Put this part before </body> tag -->