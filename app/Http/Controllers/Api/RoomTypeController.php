<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RoomType;
use App\Http\Resources\RoomType as RoomTypeResource;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return RoomTypeResource::collection(RoomType::all());
    }

    /**
     * Display the specified resource.
     *
     * @param RoomType $roomType
     * @return RoomTypeResource
     */
    public function show(RoomType $roomType)
    {
        return RoomTypeResource::make($roomType);
    }
}
