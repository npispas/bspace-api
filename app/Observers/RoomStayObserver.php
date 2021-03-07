<?php

namespace App\Observers;

use App\Mail\ReservationConfirmed;
use App\Models\RoomStay;
use Illuminate\Support\Facades\Mail;

class RoomStayObserver
{
    /**
     * Handle the RoomStay "updated" event.
     *
     * @param  \App\Models\RoomStay  $roomStay
     * @return void
     */
    public function updated(RoomStay $roomStay)
    {
        $reservation = $roomStay->reservation;
        $room = $roomStay->rooms()->firstOrFail();
        $guests = $roomStay->guests;

        foreach ($guests as $guest) {
            Mail::to($guest->email)->send(new ReservationConfirmed(
                'Your reservation\'s has been modified.',
                $reservation,
                $roomStay,
                $room
            ));
        }
    }
}
