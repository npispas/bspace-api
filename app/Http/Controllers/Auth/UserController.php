<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\Permission as PermissionResource;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Get the authenticated user with his permissions.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAuthUser()
    {
        return response()->json([
            'username' => Auth::user()->username,
            'image' => Auth::user()->image ?? null,
            'permissions' => PermissionResource::collection(Auth::user()->getAllPermissions())
        ]);
    }
}
