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
                $reservation,
                $roomStay,
                $room,
                'Your reservation\'s has been modified.'
            ));
        }
    }

    /**
     * Handle the RoomStay "deleted" event.
     *
     * @param  \App\Models\RoomStay  $roomStay
     * @return void
     */
    public function deleted(RoomStay $roomStay)
    {
        $reservation = $roomStay->reservation;
        $room = $roomStay->rooms()->firstOrFail();
        $guests = $roomStay->guests;

        foreach ($guests as $guest) {
            Mail::to($guest->email)->send(new ReservationConfirmed(
                $reservation,
                $roomStay,
                $room,
                'Your reservation\'s has been canceled.'
            ));
        }
    }
}
