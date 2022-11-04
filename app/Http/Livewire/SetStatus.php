<?php

namespace App\Http\Livewire;

use App\Jobs\NotifyAllVoters;
use App\Models\Comment;
use App\Models\discussion;
use Illuminate\Http\Response;
use Livewire\Component;

class SetStatus extends Component
{
    public $discussion;
    public $status;
    public $comment;
    public $notifyAllVoters;

    public function mount(discussion $discussion){
        $this->discussion = $discussion;
        $this->status = $this->discussion->status_id;
    }

    public function setStatus(){
        if(! auth()->check() || ! auth()->user()->isAdmin()){
            abort(Response::HTTP_FORBIDDEN);
        }
        if ($this->discussion->status_id === (int) $this->status){
            $this->emit('statusWasUpdatedError', 'Status is the same!');
            //do nothing
            return;
        }
        $this->discussion->status_id = $this->status;
        $this->discussion->save();

        if($this->notifyAllVoters){
            NotifyAllVoters::dispatch($this->discussion);
        }
        Comment::create([
            'user_id' => auth()->id(),
            'discussion_id' => $this->discussion->id,
            'status_id' => $this->status,
            'body' => $this->comment ?? 'No comment was added.',
            'is_status_update' => true,
        ]);
        $this->emit('statusWasUpdated', 'Status was updated sucessfully!');
    }

    public function render()
    {
        return view('livewire.set-status');
    }
}
