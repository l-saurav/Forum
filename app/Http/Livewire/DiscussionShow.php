<?php

namespace App\Http\Livewire;

use App\Models\discussion;
use Livewire\Component;
use App\Exceptions\DuplicateVoteException;
use App\Exceptions\VoteNotFoundException;
use App\Http\Livewire\Traits\WithAuthRedirects;

class DiscussionShow extends Component
{
    use WithAuthRedirects;
    public $discussion;
    public $votesCount;
    public $hasVoted;

    protected $listeners = ['statusWasUpdated', 'statusWasUpdatedError', 'discussionWasUpdated', 'discussionWasMarkedAsSpam', 'discussionWasMarkedAsNotSpam', 'commentWasAdded','commentWasDeleted',];

    public function mount(discussion $discussion, $votesCount)
    {
        $this->discussion = $discussion;
        $this->votesCount = $votesCount;
        $this->hasVoted = $discussion->isVotedByUser(auth()->user());
    }

    public function statusWasUpdated(){
        $this->discussion->refresh();
    }
    public function statusWasUpdatedError(){
        $this->discussion->refresh();
    }
    public function discussionWasUpdated(){
        $this->discussion->refresh();
    }
    public function discussionWasMarkedAsSpam(){
        $this->discussion->refresh();
    }
    public function discussionWasMarkedAsNotSpam(){
        $this->discussion->refresh();
    }
    public function commentWasAdded()
    {
        $this->discussion->refresh();
    }
    public function commentWasDeleted()
    {
        $this->discussion->refresh();
    }

    public function vote()
    {
        if (auth()->guest()) {
            return $this->redirectToLogin();
        }

        if ($this->hasVoted){
            try{
                $this->discussion->removeVote(auth()->user());
            }catch (VoteNotFoundException $e){
                //do nothing
            }
            $this->votesCount--;
            $this->hasVoted = false;
        }else{
            try{
                $this->discussion->Vote(auth()->user());
            }catch(DuplicateVoteException $e){
                //do nothing
            }
            $this->votesCount++;
            $this->hasVoted = true;
        }
    }

    public function render()
    {
        return view('livewire.discussion-show');
    }
}
