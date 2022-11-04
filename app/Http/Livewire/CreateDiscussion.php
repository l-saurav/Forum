<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\WithAuthRedirects;
use App\Models\Category;
use App\Models\discussion;
use Illuminate\Http\Response;
use Illuminate\Http\Client\ResponseSequence;
use Livewire\Component;

class CreateDiscussion extends Component
{
    use WithAuthRedirects;
    public $title;
    public $category = 1;
    public $description;

    protected $rules = [
        'title' => 'required|min:4',
        'category' => 'required|integer|exists:categories,id',
        'description' => 'required|min:4',
    ];

    public function createDiscussion()
    {
        if (auth()->guest()) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $this->validate();
        $discussion = discussion::create([
            'user_id' => auth()->id(),
            'category_id' => $this->category,
            'status_id' => 1,
            'title' => $this->title,
            'description' => $this->description,
        ]);
        $discussion->vote(auth()->user());
        session()->flash('success_message', 'New Discussion was added Successfully!');
        $this->reset();
        return redirect()->route('discussion.index');
    }

    public function render()
    {
        return view('livewire.create-discussion', [
            'categories' => Category::all(),
        ]);
    }
}
