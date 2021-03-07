<?php

namespace App\Observers;

use App\Mail\ReservationConfirmed;
use App\Models\Room;
use Illuminate\Support\Facades\Mail;

class RoomObserver
{
    /**
     * Handle the Room "updated" event.
     *
     * @param  \App\Models\Room  $room
     * @return void
     */
    public function updated(Room $room)
    {
        $roomStays = $room->roomStays;

        foreach ($roomStays as $roomStay) {
            $guests = $roomStay->guests;
            $reservation = $roomStay->reservation;

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
}
