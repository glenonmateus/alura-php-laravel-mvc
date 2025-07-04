<?php

namespace App\Listeners;

use App\Events\SeriesCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogSeriesCreatedListener implements ShouldQueue
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
     * @param  \App\Events\SeriesCreatedEvent  $event
     * @return void
     */
    public function handle(SeriesCreatedEvent $event)
    {
        Log::info("Série {$event->name} criada com sucesso");
    }
}
