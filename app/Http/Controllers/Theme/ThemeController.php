<?php

namespace App\Http\Controllers\Theme;

use App\Facades\Theme as ThemeFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\Theme\StoreRequest;
use App\Http\Requests\Theme\UpdateRequest;
use App\Http\Resources\Theme\ThemeResource;
use App\Http\Resources\Theme\ThemeWithMessageResource;
use App\Models\Theme;
use Inertia\Inertia;

class ThemeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $theme = $request->themeData();
        ThemeFacade::store($theme);

        return redirect()->route('branches.show', ['branch' => $theme->branch_id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Theme $theme)
    {
        return Inertia::render('Theme/Show', ['theme' => ThemeWithMessageResource::make($theme)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Theme $theme)
    {
        $theme = ThemeResource::make($theme);

        return Inertia::render('Theme/Update', ['theme' => $theme]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Theme $theme)
    {
        ThemeFacade::update($request->themeData(), $theme);

        return redirect()->route('branches.show', ['branch' => $theme->branch_id], 303);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Theme $theme)
    {
        $branchId = $theme->branch_id;
        $theme->delete();

        return redirect()->route('branches.show', ['branch' => $branchId], 303);
    }
}
