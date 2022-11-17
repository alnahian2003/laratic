<?php

namespace App\Listeners;

use App\Events\PostCreated;
use App\Mail\Admin\NewPostCreatedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class NotifyAdminAboutNewCreatedPostListener
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
     * @param  \App\Events\PostCreated  $event
     * @return void
     */
    public function handle(PostCreated $event)
    {
        Mail::to(auth()->user()->email)->send(new NewPostCreatedMail($event->post));
    }
}
