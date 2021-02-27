<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Room as RoomResource;
use App\Models\Image;
use App\Models\Room;
use App\Models\RoomType;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
        return RoomResource::collection(Room::all()->load('images', 'roomType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RoomResource
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
            'is_published' => ['required', 'integer', 'min:0', 'max:1'],
            'description' => ['required', 'string', 'max:191'],
            'images.*' => ['sometimes', 'mimes:jpg,bmp,png']
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

        $files = $request->file('images');

        if (!empty($files)) {
            foreach ($files as $file) {
                $room->saveImage($file);
            }
        }

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
    public function availability(Request $request)
    {
        $validated = $this->validate($request, [
            'start_date' => ['required', 'date_format:Y-m-d'],
            'end_date' => ['required', 'date_format:Y-m-d', 'after_or_equal:start_date'],
            'guest_count' => ['required', 'numeric', 'between:1,10'],
        ]);

        $rooms = Room::whereOccupancy($validated['guest_count'])
            ->whereAvailable($validated['start_date'], $validated['end_date'])
            ->with('images', 'roomType')
            ->get();

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
    public function update(Request $request, Room $room)
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
            'is_published' => ['required', 'integer', 'min:0', 'max:1'],
            'description' => ['required', 'string', 'max:191'],
            'images.*' => ['sometimes', 'mimes:jpg,bmp,png']
        ]);

        $room->name = $request->get('name');
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

        $files = $request->file('images');

        if (!empty($files)) {
            foreach ($files as $file) {
                $room->saveImage($file);
            }
        }

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
