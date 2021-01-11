<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Resources\User as UserResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $users = User::where('id', '!=', Auth::user()->id)->get()->load('permissions');

        return UserResource::collection($users);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return UserResource
     */
    public function show(User $user)
    {
        return UserResource::make($user->load('permissions'));
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
            'username' => ['required', 'string'],
            'email' => ['required', 'string'],
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'password' => ['required', 'string'],
            'repeat_password' => ['required', 'string'],
            'role' => ['required', 'integer', 'min:1'],
            'permissions' => ['required', 'array'],
        ]);

        $user = new User();
        $user->username = $request->get('username');
        $user->email = $request->get('email');
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->password = Hash::make($request->get('password'));
        $user->email_verified_at = now();
        $user->save();

        $user->assignRole($request->get('role'));

        foreach ($request->get('permissions') as $permission) {
            $user->givePermissionTo($permission['name']);
        }

        return response()->json('Created', Response::HTTP_CREATED);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'permissions.*' => ['required', 'string', 'min:5'],
        ]);

        $userPermissions = $user->getAllPermissions();

        foreach ($userPermissions as $permission) {
            $user->revokePermissionTo($permission->name);
        }

        foreach ($request->get('permissions') as $permission) {
            $user->givePermissionTo($permission);
        }

        return response()->json([], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     * @throws Exception
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([], Response::HTTP_OK);
    }
}
