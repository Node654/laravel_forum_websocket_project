<?php

namespace App\Http\Controllers\User;

use App\Facades\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdatePersonalRequest;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    public function personal(): Response
    {
        return Inertia::render('Personal/Show', ['user' => new UserResource(auth()->user())]);
    }

    public function update(UpdatePersonalRequest $request): JsonResource
    {
        return User::updatePersonal($request->personalData());
    }
}
