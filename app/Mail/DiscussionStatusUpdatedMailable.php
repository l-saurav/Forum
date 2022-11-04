<?php

namespace App\Mail;

use App\Models\discussion;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DiscussionStatusUpdatedMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $discussion;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(discussion $discussion)
    {
        $this->discussion = $discussion;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('An idea you voted for has a new status')->markdown('emails.discussion-status-updated');
    }
}
