<?php

namespace App\Http\Livewire;

use App\Models\discussion;
use Livewire\Component;
use Illuminate\Http\Response;

class MarkDiscussionAsNotSpam extends Component
{
    public $discussion;
    public function mount(discussion $discussion){
        $this->discussion = $discussion;
    } 
    public function markAsNotSpam(){
        if(auth()->guest() || !auth()->user()->isAdmin()){
            abort(Response::HTTP_FORBIDDEN);
        }
        $this->discussion->spam_reports = 0;
        $this->discussion->save();
        $this->emit('discussionWasMarkedAsNotSpam','Spam Counter was reset!');
    }

    public function render()
    {
        return view('livewire.mark-discussion-as-not-spam');
    }
}
