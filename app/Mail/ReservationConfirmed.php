<?php

namespace App\Mail;

use App\Models\Reservation;
use App\Models\Room;
use App\Models\RoomStay;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservationConfirmed extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Instance of Reservation
     *
     * @var Reservation
     */
    protected $reservation;

    /**
     * Instance of RoomStay
     *
     * @var RoomStay
     */
    protected $roomStay;

    /**
     * Instance of Room
     *
     * @var Room
     */
    protected $room;

    /**
     * Message to be shown.
     *
     * @var string
     */
    protected $message;

    /**
     * Create a new message instance.
     *
     * @param string $message
     * @param Reservation|null $reservation
     * @param RoomStay|null $roomStay
     * @param Room|null $room
     */
    public function __construct(string $message, Reservation $reservation = null, RoomStay $roomStay = null, Room $room = null)
    {
        $this->reservation = $reservation;
        $this->roomStay = $roomStay;
        $this->room = $room;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.reservations.confirmed', [
            'reservation' => $this->reservation,
            'roomStay' => $this->roomStay,
            'room' => $this->room,
            'message' => $this->message
        ]);
    }
}
