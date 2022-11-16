<?php

namespace App\Listeners;

use App\Events\CommentCreated;
use App\Mail\SendNewCommentCreatedMailToAdmin;
use Illuminate\Support\Facades\Mail;

class AlertAdminAboutNewComment
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\CommentCreated  $event
     * @return void
     */
    public function handle(CommentCreated $event)
    {
        Mail::to("a.alnahian2003@gmail.com")->send(new SendNewCommentCreatedMailToAdmin($event));
    }
}
