<?php

namespace App\Providers;

use App\Events\ProductCreated;
use Illuminate\Support\Facades\Event;
use App\Listeners\SendProductCreatedNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        ProductCreated::class => [
            SendProductCreatedNotification::class,
        ],
    ];

    public function shouldDiscoverEvents()
    {
        return false;
    }

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
