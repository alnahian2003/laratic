<x-mail::message>
# A New Post by _{{ $post->user->name }}_ is Waiting For Review!


**Title:** {{ $post->title }}

**Body:** {{ str()->limit($post->body, 100, "...") }}

<x-mail::button :url="route('posts.show', $post->id)">
    View Post
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
