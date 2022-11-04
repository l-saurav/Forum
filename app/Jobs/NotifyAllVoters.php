<?php

namespace App\Jobs;

use App\Models\discussion;
use Illuminate\Support\Facades\Mail;
use App\Mail\DiscussionStatusUpdatedMailable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NotifyAllVoters implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $discussion;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(discussion $discussion)
    {
        $this->discussion = $discussion;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->discussion->votes()->select('name', 'email')->chunk(100, function ($voters) {
            foreach ($voters as $user) {
                Mail::to($user)->queue(new DiscussionStatusUpdatedMailable($this->discussion));
            }
        });
    }
}
