<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckinReservationRequest;
use App\Http\Requests\SearchReservationRequest;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
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
        return ReservationResource::collection(Reservation::all()->load('roomStays', 'roomStays.guests'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreReservationRequest $request
     * @return ReservationResource
     */
    public function store(StoreReservationRequest $request)
    {
        $reservation = Reservation::create($request->validated());

        return ReservationResource::make($reservation->load(
            'roomStays',
            'roomStays.rooms',
            'roomStays.rooms.roomType',
            'roomStays.guests',
        ));
    }

    /**
     * Search reservation with the provided reservation_id and guest's email.
     *
     * @param Request $request
     * @return ReservationResource
     * @throws \Illuminate\Validation\ValidationException
     */
    public function search(SearchReservationRequest $request)
    {
        $validated = $request->validated();

        $reservation = Reservation::whereUniqueId($validated['reservation_id'])
            ->whereGuestEmail($validated['email'])
            ->firstOrFail();

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
     * Checkin a guest for a specific reservation.
     *
     * @param Request $request
     * @param Reservation $reservation
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function checkin(CheckinReservationRequest $request, Reservation $reservation)
    {
        $reservation->checkin($request->validated());

        return response()->json([], Response::HTTP_NO_CONTENT);
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
     * @return ReservationResource
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(UpdateReservationRequest $request, Reservation $reservation)
    {
        $reservation->update($request->validated());

        return ReservationResource::make($reservation->refresh());
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
