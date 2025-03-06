<?php

namespace App\Http\Controllers\Section;

use App\Facades\Section as SectionFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\Section\StoreRequest;
use App\Http\Requests\Section\UpdateRequest;
use App\Http\Resources\Notification\NotificationResource;
use App\Http\Resources\Section\SectionResource;
use App\Http\Resources\Section\SectionWithBranchesResource;
use App\Models\Notification;
use App\Models\Section;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;

class SectionController extends Controller
{
    public function index()
    {
        return Inertia::render(
            'Section/Index',
            [
                'sections' => SectionWithBranchesResource::collection(SectionFacade::getSections(['parentBranches'])),
            ]
        );
    }

    public function create()
    {
        return Inertia::render('Section/Create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        SectionFacade::store($request->sectionData());

        return redirect()->route('sections.index');
    }

    public function show(Section $section)
    {
        //
    }

    public function edit(Section $section)
    {
        return Inertia::render('Section/Update', ['section' => SectionResource::make($section)]);
    }

    public function update(UpdateRequest $request, Section $section)
    {
        SectionFacade::update($request->sectionData(), $section);

        return redirect()->route('sections.index');
    }

    public function destroy(Section $section)
    {
        $section->delete();

        return redirect()->route('sections.index');
    }
}
