<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ToggleRoleRequest;
use App\Http\Resources\Role\RoleResource;
use App\Http\Resources\User\UserWithRoleResource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    public function index(): Response
    {
        $roles = RoleResource::collection(Role::all());
        $users = UserWithRoleResource::collection(User::all());

        return Inertia::render('Admin/User/Index', compact('users', 'roles'));
    }

    public function toggleRole(User $user, ToggleRoleRequest $request): JsonResource
    {
        $data = $request->validated();
        $user->roles()->toggle($data);

        return UserWithRoleResource::make($user);
    }
}
