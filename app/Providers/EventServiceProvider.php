<?php

namespace App\Providers;

use App\Models\Guest;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\RoomStay;
use App\Observers\GuestObserver;
use App\Observers\ReservationObserver;
use App\Observers\RoomObserver;
use App\Observers\RoomStayObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Reservation::observe(ReservationObserver::class);
        RoomStay::observe(RoomStayObserver::class);
        Guest::observe(GuestObserver::class);
        Room::observe(RoomObserver::class);
    }
}
