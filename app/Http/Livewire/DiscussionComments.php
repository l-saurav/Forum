<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\discussion;
use Livewire\Component;
use Livewire\WithPagination;

class DiscussionComments extends Component
{
    use WithPagination;
    public $discussion;
    protected $listeners = ['commentWasAdded','commentWasDeleted','statusWasUpdated'];

    public function commentWasAdded()
    {
        $this->discussion->refresh();
        $this->gotoPage($this->discussion->comments()->paginate()->lastPage());
    }
    public function statusWasUpdated()
    {
        $this->discussion->refresh();
        $this->gotoPage($this->discussion->comments()->paginate()->lastPage());
    }
    public function commentWasDeleted()
    {
        $this->discussion->refresh();
        $this->gotoPage(1);
    }

    public function mount(discussion $discussion){
        $this->discussion = $discussion;
    }

    public function render()
    {
        return view('livewire.discussion-comments', [
            //'comments' => $this->discussion->comments()->paginate()->withQueryString(),
            'comments' => Comment::with(['user', 'status'])->where('discussion_id', $this->discussion->id)->paginate()->withQueryString(),
        ]);
    }
}
