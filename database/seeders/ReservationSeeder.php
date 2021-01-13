<?php

namespace Database\Seeders;

use App\Models\Guest;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\Image;
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

        Image::factory()
            ->for($room, 'imageable')
            ->create();

        Image::factory()
            ->for($room, 'imageable')
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

        $guest2 = Guest::factory()
            ->for($reservation)
            ->for($roomStay)
            ->create();

        Image::factory()
            ->for($guest, 'imageable')
            ->create();

        Image::factory()
            ->for($guest2, 'imageable')
            ->create();
    }
}
