<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Carbon\Carbon;

class MetricController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke()
    {
        $revenue = 0.00;
        $guests = 0;
        $occupancy = 0;
        $days = [];
        $reservationsPerDay = [];

        $reservations = Reservation::all()->load('roomStays');
        // Calculate the current month's total reservations.
        $reservationCount = count($reservations);

        // Check if there are any reservations in the system.
        if ($reservationCount > 0) {

            // Calculate the current month's revenue and total guests.
            foreach ($reservations as $reservation) {
                $revenue += $reservation->total_amount;
                $guests += $reservation->guest_count;
            }

            $startOfCurrentWeek = Carbon::now()->startOf('week');
            $endOfCurrentWeek = Carbon::now()->endOf('week');

            // Calculate the number of reservations on daily basis for the current month.
            for ($day = $startOfCurrentWeek; $day <= $endOfCurrentWeek; $day->addDay()) {
                $days[] = sprintf("%s %s", $day->shortMonthName, $day->day);
                $reservationsPerDay[$day->day] = 0;

                foreach ($reservations as $reservation) {
                    $startDate = Carbon::createFromFormat('Y-m-d', $reservation->roomStays[0]->start_date);
                    $endDate = Carbon::createFromFormat('Y-m-d', $reservation->roomStays[0]->end_date);

                    if ($day->betweenIncluded($startDate->format('Y-m-d'), $endDate->format('Y-m-d'))) {
                        $reservationsPerDay[$day->day]++;
                    }
                }
            }
        }

        return response()->json([
            'data' => [
                'reservation_count' => $reservationCount,
                'guest_count' => $guests,
                'revenue' => $revenue,
                'occupancy' => 10,
                'days' => array_values($days),
                'reservations_per_day' => array_values($reservationsPerDay)
            ]
        ]);
    }
}
