<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Resources\User as UserResource;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        return UserResource::collection(User::all());
    }
}
