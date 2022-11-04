@component('mail::message')
# Discussion Status Updated

The discussion: {{ $discussion->title }}

has been updated to a status of: {{ $discussion->status->name }}

@component('mail::button', ['url' => route('discuss.show', $discussion)])
View Idea
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
