<?php

namespace App\Listeners;

use App\Events\DeleteSeriesCoverEvent;
use Illuminate\Support\Facades\Storage;

class DeleteSeriesCoverListener
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
     * @param  \App\Events\SeriesDeletedEvent  $event
     * @return void
     */
    public function handle(DeleteSeriesCoverEvent $event)
    {
        Storage::disk('public')->delete($event->cover);
    }
}
