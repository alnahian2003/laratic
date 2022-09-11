@extends('posts/template')
<!-- component -->
<link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">

<main class="profile-page">
  <section class="relative py-16 bg-blueGray-200">
    <div class="container mx-auto px-4">
      <div class="relative flex flex-col min-w-0 break-words bg-base-200 w-full mb-6 shadow-xl rounded-lg">
        <div class="px-6">
          <div class="flex flex-wrap justify-center">
            <div class="w-full lg:w-3/12 px-4 lg:order-2 flex justify-center">
              <div class="text-center">
                <img alt="..." src="https://eu.ui-avatars.com/api/?name={{ $user->username }}&format=svg&background=random&size=200" class="shadow-xl rounded-full h-auto align-middle border-none absolute -m-16 lg:-ml-16 max-w-150-px">
              </div>
            </div>
            <div class="w-full lg:w-4/12 px-4 lg:order-3 lg:text-right lg:self-center">
            </div>
            <div class="w-full lg:w-4/12 px-4 lg:order-3">

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
                      <thead class="text-xs text-neutral-base uppercase bg-neutral">
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
                        <tr class="bg-base border-b">
                          <th scope="row" class="py-4 px-6 font-medium whitespace-nowrap text-neutral-content">
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
                          <td class="py-4 px-6 flex flex-row gap-4">
                            <form action="{{route('posts.edit', $post->id)}}" method="post">
                              @csrf
                              <input class="btn btn-info btn-sm" type="submit" value="Edit">
                            </form>
                            <form action="{{route('posts.destroy', $post->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <input class="btn btn-error btn-sm" type="submit" value="Delete">
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