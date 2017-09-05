<?php

namespace Minion\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mMinionings for the Minionlication.
     *
     * @var array
     */
    protected $listen = [
        'Minion\Events\Event' => [
            'Minion\Listeners\EventListener',
        ],
    ];

    /**
     * Register any events for your Minionlication.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
