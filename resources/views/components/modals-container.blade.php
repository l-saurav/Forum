@can('update', $discussion)
    <livewire:edit-discussion :discussion="$discussion" />
@endcan
@can('delete', $discussion)
    <livewire:delete-discussion :discussion="$discussion" />
@endcan
@auth
    <livewire:mark-discussion-as-spam :discussion="$discussion" />
@endauth
@admin
    <livewire:mark-discussion-as-not-spam :discussion="$discussion" />
@endadmin
@auth
    <livewire:edit-comment />
@endauth
@auth
    <livewire:delete-comment />
@endauth
@auth
    <livewire:mark-comment-as-spam />
@endauth
@admin
    <livewire:mark-comment-as-not-spam />
@endadmin