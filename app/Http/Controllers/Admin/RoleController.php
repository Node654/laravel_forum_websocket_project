<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\StoreRequest;
use App\Http\Resources\Role\RoleResource;
use App\Http\Resources\Section\SectionResource;
use App\Models\Role;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Inertia\Inertia;
use Inertia\Response;

class RoleController extends Controller
{
    public function index(): Response
    {
        $roles = Role::all();
        $roles = RoleResource::collection($roles);

        return Inertia::render('Admin/Role/Index', compact('roles'));
    }

    public function create(): Response
    {
        $sections = Section::all();
        $sections = SectionResource::collection($sections);

        return Inertia::render('Admin/Role/Create', compact('sections'));
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $code = Arr::get($data, 'title');
        if (Arr::get($data, 'branch_id')) {
            $code .= ".$data[section_id]".".$data[branch_id]";
        } elseif (! Arr::get($data, 'branch_id') && Arr::get($data, 'section_id')) {
            $code .= ".$data[section_id]";
        }
        Role::query()->firstOrCreate([
            'title' => Arr::get($data, 'title'),
            'code' => $code,
        ]);

        return redirect()->route('admins.roles.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
