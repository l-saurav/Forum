<nav class="items-center justify-between hidden text-xs text-gray-400 md:flex">
    <ul class="flex pb-3 space-x-10 font-semibold uppercase border-b-4">
        <li><a wire:click.prevent="setStatus('All')" href="{{ route('discussion.index', ['status' => 'All' ]) }}" class="transition duration-150 ease-in border-b-4 pb-3 hover:border-blue @if($status==='All') border-blue text-gray-900 @endif">All Discussion ({{ $statusCount['all_statuses'] }})</a></li>
        <li><a wire:click.prevent="setStatus('Off Topic')" href="{{ route('discussion.index', ['status' => 'Off Topic' ]) }}" class="transition duration-150 ease-in border-b-4 pb-3 hover:border-blue @if($status==='Off Topic') border-blue text-gray-900 @endif ">Off Topic ({{ $statusCount['off_topic'] }})</a></li>
        <li><a wire:click.prevent="setStatus('Announcement')" href="{{ route('discussion.index', ['status' => 'Announcement' ]) }}" class="transition duration-150 ease-in border-b-4 pb-3 hover:border-blue @if($status==='Announcement') border-blue text-gray-900 @endif">Announcement ({{ $statusCount['announcement'] }})</a></li>
    </ul>
    <ul class="flex pb-3 space-x-10 font-semibold uppercase border-b-4">
        <li><a wire:click.prevent="setStatus('Unsolved')" href="{{ route('discussion.index', ['status' => 'Unsolved' ]) }}" class="transition duration-150 ease-in border-b-4 pb-3 hover:border-blue @if($status==='Unsolved') border-blue text-gray-900 @endif">Unsolved ({{ $statusCount['unsolved'] }})</a></li>
        <li><a wire:click.prevent="setStatus('Solved')" href="{{ route('discussion.index', ['status' => 'Solved' ]) }}" class="transition duration-150 ease-in border-b-4 pb-3 hover:border-blue @if($status==='Solved') border-blue text-gray-900 @endif">Solved ({{ $statusCount['solved'] }})</a></li>
    </ul>
</nav>