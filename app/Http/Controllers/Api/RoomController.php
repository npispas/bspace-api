<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Room as RoomResource;
use App\Models\Room;
use App\Models\RoomType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return RoomResource::collection(Room::all()->load('roomImages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:100'],
            'location' => ['required', 'string', 'max:100'],
            'interior_size' => ['required', 'integer', 'min:10'],
            'min_occupancy' => ['required', 'integer', 'min:1'],
            'max_occupancy' => ['required', 'integer', 'min:1'],
            'available_from' => ['required', 'date'],
            'available_to' => ['required', 'date'],
            'room_type_id' => ['required', 'integer'],
            'is_published' => ['required', 'boolean'],
            'description' => ['required', 'string', 'max:191'],
            'images' => ['required', 'array'],
        ]);

        $room = new Room();
        $room->name = $request->get('name');
        $room->unique_id = Str::uuid();
        $room->location = $request->get('location');
        $room->interior_size = $request->get('interior_size');
        $room->min_occupancy = $request->get('min_occupancy');
        $room->max_occupancy = $request->get('max_occupancy');
        $room->available_from = $request->get('available_from');
        $room->available_to = $request->get('available_to');
        $room->is_published = $request->get('is_published');
        $room->description = $request->get('description');

        $roomType = RoomType::findOrFail($request->get('room_type_id'));
        $roomType->rooms()->save($room);

        // Todo Store Room Images

        return response()->json('', Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param Room $room
     * @return RoomResource
     */
    public function show(Room $room)
    {
        return RoomResource::make($room->load('roomImages', 'roomType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Room $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        //
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
