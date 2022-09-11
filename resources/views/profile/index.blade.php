@extends('posts/template')
<!-- component -->
<link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
<link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">

<main class="profile-page">
  <section class="relative block h-500-px">
    <div class="absolute top-0 w-full h-full bg-center bg-cover" style="
            background-image: url('https://images.unsplash.com/photo-1499336315816-097655dcfbda?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=2710&amp;q=80');
          ">
      <span id="blackOverlay" class="w-full h-full absolute opacity-50 bg-black"></span>
    </div>
    <div class="top-auto bottom-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden h-70-px" style="transform: translateZ(0px)">
      <svg class="absolute bottom-0 overflow-hidden" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" version="1.1" viewBox="0 0 2560 100" x="0" y="0">
        <polygon class="text-blueGray-200 fill-current" points="2560 0 2560 100 0 100"></polygon>
      </svg>
    </div>
  </section>
  <section class="relative py-16 bg-blueGray-200">
    <div class="container mx-auto px-4">
      <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-xl rounded-lg -mt-64">
        <div class="px-6">
          <div class="flex flex-wrap justify-center">
            <div class="w-full lg:w-3/12 px-4 lg:order-2 flex justify-center">
              <div class="relative">
                <img alt="..." src="https://eu.ui-avatars.com/api/?name={{ $user->username }}&format=svg&background=random&size=200" class="shadow-xl rounded-full h-auto align-middle border-none absolute -m-16 -ml-20 lg:-ml-16 max-w-150-px">
              </div>
            </div>
            <div class="w-full lg:w-4/12 px-4 lg:order-3 lg:text-right lg:self-center">
            </div>
            <div class="w-full lg:w-4/12 px-4 lg:order-1">
              <div class="flex justify-center py-4 lg:pt-4 pt-8">
                <div class="mr-4 p-3 text-center">
                  <span class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">22</span><span class="text-sm text-blueGray-400">Friends</span>
                </div>
                <div class="mr-4 p-3 text-center">
                  <span class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">10</span><span class="text-sm text-blueGray-400">Photos</span>
                </div>
                <div class="lg:mr-4 p-3 text-center">
                  <span class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">89</span><span class="text-sm text-blueGray-400">Comments</span>
                </div>
              </div>
            </div>
          </div>
          <div class="text-center mt-12">
            <h3 class="text-4xl font-semibold leading-normal text-blueGray-700 mb-2">
              {{$user->name}}
            </h3>
            <div class="text-sm leading-normal mt-0 mb-2 text-blueGray-400 font-bold">
              {{$user->username}}
            </div>
          </div>
          <div class="mt-10 py-10 border-t border-blueGray-200 text-center">
            <div class="flex flex-wrap justify-center">
              <div class="w-full px-4">
                
                <div class="overflow-x-auto relative">
                  <table class="w-full text-sm text-left text-gray-500">
                      <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                          <tr>
                              <th scope="col" class="py-3 px-6">
                                  Title
                              </th>
                              <th scope="col" class="py-3 px-6">
                                  Date
                              </th>
                              <th scope="col" class="py-3 px-6">
                                  Views
                              </th>
                              <th scope="col" class="py-3 px-6">
                                  Actions
                              </th>
                          </tr>
                      </thead>
                      <tbody>
                        @forelse ($posts as $post)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                          <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <a class="hover:underline" href="{{route('posts.show', $post->id)}}" target="_blank">
                              {{substr($post->title, 0, 50)}}...
                            </a>
                              
                          </th>
                          <td class="py-4 px-6">
                              {{$post->created_at->diffForHumans()}}
                          </td>
                          <td class="py-4 px-6">
                              {{$post->views}}
                          </td>
                          <td class="py-4 px-6">
                              <form action="{{route('posts.destroy', $post->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <input class="btn btn-error btn-small" type="submit" value="Delete">
                              </form>
                          </td>
                      </tr>
                        @empty
                            You have no posts!
                        @endforelse
                          
                      </tbody>
                  </table>
                  <div class="my-6">{{$posts->links()}}</div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>