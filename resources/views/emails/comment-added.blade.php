@component('mail::message')
# A comment was posted on your idea

{{ $comment->user->name }} commented on your idea:

**{{ $comment->discussion->title }}**

Comment: {{ $comment->body }}

@component('mail::button', ['url' => route('discuss.show', $comment->discussion)])
Go to Discussion
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
