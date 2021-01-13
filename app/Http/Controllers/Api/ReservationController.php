<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Http\Resources\Reservation as ReservationResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return ReservationResource::collection(Reservation::all()->load('roomStays.guests'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return ReservationResource
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Reservation $reservation
     * @return ReservationResource
     */
    public function show(Reservation $reservation)
    {
        return ReservationResource::make($reservation->load(
            'roomStays',
            'roomStays.rooms',
            'roomStays.rooms.roomType',
            'roomStays.rooms.images',
            'roomStays.guests',
            'roomStays.guests.image'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Reservation $reservation
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Reservation $reservation)
    {
        $this->validate($request, [
            'start_date' => ['required', 'date'],
            'start_hour' => ['required', 'date_format:H:i:s'],
            'end_date' => ['required', 'date'],
            'end_hour' => ['required', 'date_format:H:i:s'],
            'room' => ['required', 'integer', 'min:1']
        ]);

        $roomStay = $reservation->roomStays()->firstOrFail();
        $roomStay->start_date = $request->get('start_date');
        $roomStay->start_hour = $request->get('start_hour');
        $roomStay->end_date = $request->get('start_date');
        $roomStay->end_hour = $request->get('start_hour');
        $roomStay->rooms()->sync($request->get('room'));
        $roomStay->save();

        return response()->json([], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Reservation $reservation
     * @return \Illuminate\Http\JsonResponse
     * @throws Exception
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return response()->json([], Response::HTTP_OK);
    }

    /**
     * Generate a test reservation.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function generate()
    {
        Artisan::call('reservations:generate', ['number' => '1']);

        return response()->json([], Response::HTTP_OK);
    }
}
