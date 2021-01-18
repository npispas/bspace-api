<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\Permission as PermissionResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
            'user' => [
                'username' => Auth::user()->username,
                'image' => Auth::user()->image ?? null,
            ],
            'permissions' => PermissionResource::collection(Auth::user()->getAllPermissions())
        ]);
    }



    /**
     * Save user's avatar.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function storeImage(Request $request)
    {
        $this->validate($request, [
            'image' => ['required', 'mimes:jpg,bmp,png']
        ]);

        Auth::user()->saveImage($request->file('image'));

        return response()->json('', Response::HTTP_CREATED);
    }
}
