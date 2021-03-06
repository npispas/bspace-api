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
            $reservation,
            $roomStay,
            $room,
            'Below you will find your reservation\'s details.'
        ));
    }
}
