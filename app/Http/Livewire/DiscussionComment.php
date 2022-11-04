<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;

class DiscussionComment extends Component
{
    public $comment;
    public $discussionUserId;
    protected $listeners = ['commentWasUpdated','commentWasMarkedAsSpam','commentWasMarkedAsNotSpam',];

    public function commentWasUpdated()
    {
        $this->comment->refresh();
    }
    public function commentWasMarkedAsSpam()
    {
        $this->comment->refresh();
    }
    public function commentWasMarkedAsNotSpam()
    {
        $this->comment->refresh();
    }
    

    public function mount(Comment $comment, $discussionUserId){
        $this->comment = $comment;
        $this->discussionUserId = $discussionUserId;
    }

    public function render()
    {
        return view('livewire.discussion-comment');
    }
}
