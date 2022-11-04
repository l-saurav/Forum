<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\discussion;
use Illuminate\Http\Response;
use Livewire\Component;

class EditDiscussion extends Component
{
    public $title;
    public $category;
    public $description;
    public $discussion;

    protected $rules = [
        'title' => 'required|min:4',
        'category' => 'required|integer|exists:categories,id',
        'description' => 'required|min:4',
    ];

    public function mount(discussion $discussion){
        $this->discussion = $discussion;
        $this->title = $discussion->title;
        $this->category = $discussion->category_id;
        $this->description = $discussion->description;
    }
    public function updateDiscussion(){
        if(auth()->guest() || auth()->user()->cannot('update', $this->discussion)){
            abort(Response::HTTP_FORBIDDEN);
        }
        $this->validate();
        $this->discussion->update([
            'title'=>$this->title,
            'category_id'=>$this->category,
            'description'=>$this->description,
        ]);
        $this->emit('discussionWasUpdated', 'Discussion was updated sucessfully!');
    }
    public function render()
    {
        return view('livewire.edit-discussion',[
            'categories' => Category::all(),
        ]);
    }
}
