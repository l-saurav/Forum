<x-app-layout>
    <x-slot name="title">
        {{$discussion->title}} | Ankuram Community Forum
    </x-slot>
    <div>
        <a href=" {{ $backUrl }} " class="flex items-center font-semibold hover:underline">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            <span class="ml-2">All discussion</span>
        </a>
    </div>

    <livewire:discussion-show :discussion="$discussion" :votesCount="$votesCount"/>
    
    <livewire:discussion-comments :discussion="$discussion">
    
    <x-notification-success />

    <x-modals-container :discussion="$discussion"/>

</x-app-layout>