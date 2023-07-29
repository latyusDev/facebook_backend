<x-mail::message>
# Your post was liked

{{$liker->name}} liked one of your posts

<x-mail::button :url="route('posts.show', $post)">
View Post
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
