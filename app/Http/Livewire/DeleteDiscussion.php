<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;
use App\Models\discussion;
use App\Models\Vote;
use Illuminate\Http\Response;

class DeleteDiscussion extends Component
{
    public $discussion;

    public function mount(discussion $discussion){
        $this->discussion = $discussion;
    }

    public function deleteDiscussion()
    {
        if(auth()->guest() || auth()->user()->cannot('delete', $this->discussion)){
            abort(Response::HTTP_FORBIDDEN);
        }
        discussion::destroy($this->discussion->id);
        session()->flash('success_message', 'Discussion was deleted Successfully!');
        return redirect()->route('discussion.index');
    }
    
    public function render()
    {
        return view('livewire.delete-discussion');
    }
}
