<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\Permission as PermissionResource;
use App\Http\Resources\Image as ImageResource;
use Illuminate\Http\Request;
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
            'id' => Auth::user()->id,
            'username' => Auth::user()->username,
            'email' => Auth::user()->email,
            'role' => Auth::user()->roles()->first(),
            'avatar' => Auth::user()->image ?? null,
            'permissions' => PermissionResource::collection(Auth::user()->getAllPermissions())
        ]);
    }

    /**
     * Save user's avatar.
     *
     * @param Request $request
     * @return ImageResource
     * @throws \Illuminate\Validation\ValidationException
     */
    public function storeImage(Request $request)
    {
        $this->validate($request, [
            'image' => ['required', 'mimes:jpg,bmp,png']
        ]);

        Auth::user()->saveImage($request->file('image'));

        return ImageResource::make(Auth::user()->image);
    }
}
