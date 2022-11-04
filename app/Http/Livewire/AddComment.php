<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\WithAuthRedirects;
use App\Models\Comment;
use App\Models\discussion;
use App\Notifications\CommentAdded;
use Livewire\Component;
use Illuminate\Http\Response;

class AddComment extends Component
{
    use WithAuthRedirects;
    public $discussion;
    public $comment;
    protected $rules = [
        'comment' => 'required|min:4',

    ];

    public function mount(discussion $discussion){
        $this->discussion = $discussion;
    }

    public function addComment()
    {
        if(auth()->guest()){
            abort(Response::HTTP_FORBIDDEN);
        }
        $this->validate();
        $newComment = Comment::create([
            'user_id' => auth()->id(),
            'discussion_id' => $this->discussion->id,
            'status_id' => 1,
            'body' => $this->comment,
        ]);
        $this->reset('comment');
        $this->discussion->user->notify(new CommentAdded($newComment));
        $this->emit('commentWasAdded','Comment was posted!');
    }

    public function render()
    {
        return view('livewire.add-comment');
    }
}
