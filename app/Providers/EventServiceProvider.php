<?php

namespace App\Providers;

use App\Events\SeriesCreatedEvent;
use App\Events\DeleteSeriesCoverEvent;
use App\Listeners\EmailUserAboutSeriesCreatedListener;
use App\Listeners\LogSeriesCreatedListener;
use App\Listeners\DeleteSeriesCoverListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        SeriesCreatedEvent::class => [
            EmailUserAboutSeriesCreatedListener::class,
            LogSeriesCreatedListener::class
        ],
        DeleteSeriesCoverEvent::class => [
            DeleteSeriesCoverListener::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
