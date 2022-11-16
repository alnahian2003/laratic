<x-mail::message>
# Hey, Got a new comment for you ✉

Check this out buddy!

**"{{ $event->comment->body }}"**

<x-mail::button :url="route('posts.show', $event->comment->post_id)">
    View Post
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
