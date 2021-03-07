<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomAvailabilityRequest;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Http\Resources\Room as RoomResource;
use App\Models\Image;
use App\Models\Room;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return RoomResource::collection(Room::all()->load('images', 'roomType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRoomRequest $request
     * @return RoomResource
     */
    public function store(StoreRoomRequest $request)
    {
        $room = Room::create($request->validated());

        return RoomResource::make($room);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Room $room
     * @param Image $image
     * @return RoomResource
     * @throws \Illuminate\Validation\ValidationException
     */
    public function deleteImage(Room $room, Image $image)
    {
        $room->deleteImage($image);

        return RoomResource::make($room->load('images', 'roomType'));
    }

    /**
     * Display the specified resource.
     *
     * @param Room $room
     * @return RoomResource
     */
    public function show(Room $room)
    {
        return RoomResource::make($room->load('images', 'roomType'));
    }

    /**
     * Search availability for a specific time period and guest count.
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     * @throws \Illuminate\Validation\ValidationException
     */
    public function availability(RoomAvailabilityRequest $request)
    {
        $validated = $request->validated();

        $roomsWithoutRoomStays = Room::doesntHave('roomStays')
            ->whereOccupancy($validated['guest_count'])
            ->with('images', 'roomType')
            ->get();

        $rooms = Room::has('roomStays')
            ->whereOccupancy($validated['guest_count'])
            ->whereAvailable($validated['start_date'], $validated['end_date'])
            ->with('images', 'roomType')
            ->get();

        $rooms = $rooms->merge($roomsWithoutRoomStays);

        if (count($rooms) === 0) {
            throw new ModelNotFoundException('No query results for App\Models\Room');
        }

        return RoomResource::collection($rooms);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Room $room
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(UpdateRoomRequest $request, Room $room)
    {
        $room->update($request->validated());

        return response()->json(RoomResource::make($room->load('images')), Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Room $room
     * @return \Illuminate\Http\JsonResponse
     * @throws Exception
     */
    public function destroy(Room $room)
    {
        $room->delete();

        return response()->json('', Response::HTTP_OK);
    }
}
