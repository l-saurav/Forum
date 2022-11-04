<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\discussion;
use Livewire\Component;
use Illuminate\Http\Response;
use Illuminate\Notifications\DatabaseNotification;

class CommentNotifications extends Component
{
    const NOTIFICATION_THRESHOLD = 9;
    public $notifications;
    public $notificationCount;
    public $isLoading;
    protected $listeners = ['getNotifications']; 

    public function mount()
    {
        $this->notifications = collect([]);
        $this->isLoading = true;
        $this->getNotificationCount();
    }
    public function getNotificationCount()
    {
        $this->notificationCount = auth()->user()->unreadNotifications()->count();
        if($this->notificationCount > self::NOTIFICATION_THRESHOLD){
            $this->notificationCount = self::NOTIFICATION_THRESHOLD.'+';
        }
    }
    public function getNotifications()
    {
        $this->notifications = auth()->user()->unreadNotifications()->latest()->take(self::NOTIFICATION_THRESHOLD)->get();
        $this->isLoading = false;
    }
    public function markAsRead($notificationId)
    {
        if(auth()->guest()){
            abort(Response::HTTP_FORBIDDEN);
        }
        $notification = DatabaseNotification::findOrFail($notificationId);
        $notification->markAsRead();
        
        $this->scrollToComment($notification);
    }

    public function scrollToComment($notification){
        $discussion = discussion::find($notification->data['discussion_id']);
        if(!$discussion){
            session()->flash('error_message', 'This discussion no longer exists!');
            return redirect()->route('discussion.index');
        }
        $comment = Comment::find($notification->data['comment_id']);
        if(!$comment){
            session()->flash('error_message', 'This comment no longer exists!');
            return redirect()->route('discussion.index');
        }
        $comments = $discussion->comments()->pluck('id');
        $indexOfComment = $comments->search($comment->id);
        $page = (int) ($indexOfComment/$comment->getPerPage()) + 1;
        session()->flash('scrollToComment', $comment->id);
        return redirect()->route('discuss.show',[
            'discussion' => $notification->data['discussion_slug'],
            'page' => $page,
        ]);
    }
    public function markAllAsRead()
    {
        if(auth()->guest()){
            abort(Response::HTTP_FORBIDDEN);
        }
        auth()->user()->unreadNotifications->markAsRead();
        $this->getNotificationCount();
        $this->getNotifications();
    }

    public function render()
    {
        return view('livewire.comment-notifications');
    }
}
