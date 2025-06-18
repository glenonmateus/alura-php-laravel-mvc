<?php

namespace App\Listeners;

use App\Mail\SeriesCreated;
use App\Events\SeriesCreatedEvent;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class EmailUserAboutSeriesCreatedListener implements ShouldQueue
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
     * @param  object  $event
     * @return void
     */
    public function handle(SeriesCreatedEvent $event)
    {
        $users = User::all();
        foreach ($users as $index => $user) {
            $email = new SeriesCreated(
                $event->name,
                $event->id,
                $event->seasons,
                $event->episodesPerSeason
            );
            $when = now()->addSeconds($index * 5);
            Mail::to($user)->later($when, $email);
        }
    }
}
