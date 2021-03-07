<?php

namespace App\Observers;

use App\Mail\ReservationConfirmed;
use App\Models\Guest;
use Illuminate\Support\Facades\Mail;

class GuestObserver
{
    /**
     * Handle the Guest "created" event.
     *
     * @param  \App\Models\Guest  $guest
     * @return void
     */
    public function created(Guest $guest)
    {
        $reservation = $guest->reservation;
        $roomStay = $reservation->roomStays()->firstOrFail();
        $room = $roomStay->rooms()->firstOrFail();

        Mail::to($guest->email)->send(new ReservationConfirmed(
            'Below you will find your reservation\'s details.',
            $reservation,
            $roomStay,
            $room
        ));
    }

    /**
     * Handle the Guest "deleted" event.
     *
     * @param  \App\Models\Guest  $guest
     * @return void
     */
    public function deleted(Guest $guest)
    {
        Mail::to($guest->email)->send(new ReservationConfirmed(
            'Your reservation with confirmation ' . $guest->reservation->unique_id . 'has been canceled.',
            null,
            null,
            null
        ));
    }
}
