@extends('posts/template')
<main class="profile-page">
  <section class="relative py-16 bg-blueGray-200">
    <div class="container mx-auto px-4">
      <h1 class="text-3xl text-success font-bold">Archived Posts</h1>
      <div class="mt-10 py-10 border-t border-blueGray-200 text-center">
        <div class="flex flex-wrap justify-center">
          <div class="w-full px-4">
            <div class="overflow-x-auto relative">
              <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-neutral-base uppercase bg-neutral">
                  <tr>
                    <th scope="col" class="py-3 px-6">
                      ID
                    </th>
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
                    <td class="py-4 px-6">
                      {{$loop->iteration}}
                    </td>
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
                      @if ($post->trashed())
                      <form action="{{route('posts.restore', $post->id)}}" method="post">
                        @csrf
                        <input class="btn btn-success btn-sm" type="submit" value="Restore">
                      </form>

                      <form action="{{route('posts.force_delete', $post->id)}}" method="post">
                        @csrf
                        <input class="btn btn-error btn-sm" type="submit" value="Delete Forever">
                      </form>
                      @endif
                    </td>
                  </tr>
                  @empty
                  You have no archived posts!
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