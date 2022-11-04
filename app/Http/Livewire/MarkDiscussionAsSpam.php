<?php

namespace App\Http\Livewire;

use App\Models\discussion;
use Livewire\Component;
use Illuminate\Http\Response;

class MarkDiscussionAsSpam extends Component
{
    public $discussion;

    public function mount(discussion $discussion){
        $this->discussion = $discussion;
    }

    public function markAsSpam()
    {
        if(auth()->guest()){
            abort(Response::HTTP_FORBIDDEN);
        }
        $this->discussion->spam_reports++;
        $this->discussion->save();
        $this->emit('discussionWasMarkedAsSpam','Discussion was marked as spam!');
    }

    public function render()
    {
        return view('livewire.mark-discussion-as-spam');
    }
}
