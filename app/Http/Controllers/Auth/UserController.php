<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\Permission as PermissionResource;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Get all permissions of the Authenticated users.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function permissions()
    {
        $permissions = Auth::user()->getAllPermissions();

        return PermissionResource::collection($permissions);
    }
}
