<?php

namespace Database\Seeders;

use App\Models\Guest;
use App\Models\GuestImage;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\RoomImage;
use App\Models\RoomStay;
use App\Models\RoomType;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roomType = RoomType::factory()->create();

        $room = Room::factory()
            ->for($roomType)
            ->create();

        RoomImage::factory()
            ->for($room)
            ->create();

        $reservation = Reservation::factory()->create();

        $roomStay = RoomStay::factory()
            ->for($reservation)
            ->hasAttached($room, [
                'created_at' => now(),
                'updated_at' => now()
            ])
            ->create();

        $guest = Guest::factory()
            ->for($reservation)
            ->for($roomStay)
            ->create();

        GuestImage::factory()
            ->for($guest)
            ->create();
    }
}
