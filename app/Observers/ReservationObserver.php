<?php

namespace App\Observers;

use App\Models\Reservation;

class ReservationObserver
{
    /**
     * Handle the Reservation "deleted" event.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return void
     */
    public function deleting(Reservation $reservation)
    {
        foreach ($reservation->guests as $guest) {
            event('eloquent.deleted: App\Models\Guest', $guest);
        }
    }
}
