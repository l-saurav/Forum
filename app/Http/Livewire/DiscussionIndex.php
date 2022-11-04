<?php

namespace App\Http\Livewire;

use App\Exceptions\DuplicateVoteException;
use App\Exceptions\VoteNotFoundException;
use App\Http\Livewire\Traits\WithAuthRedirects;
use app\Models\discussion;
use Livewire\Component;

class DiscussionIndex extends Component
{
    use WithAuthRedirects;
    public $discuss;
    public $votesCount;
    public $hasVoted;
    public function mount(discussion $discuss, $votesCount)
    {
        $this->discussion = $discuss;
        $this->votesCount = $votesCount;
        $this->hasVoted = $discuss->voted_by_user;
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
        return view('livewire.discussion-index');
    }
}
