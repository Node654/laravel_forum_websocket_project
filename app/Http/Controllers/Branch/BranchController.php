<?php

namespace App\Http\Controllers\Branch;

use App\Facades\Section as SectionFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\Branch\StoreRequest;
use App\Http\Requests\Branch\UpdateRequest;
use App\Http\Resources\Branch\BranchResource;
use App\Http\Resources\Branch\BranchWithChildrenResource;
use App\Http\Resources\Section\SectionResource;
use App\Http\Resources\Section\SectionWithBranchesResource;
use App\Models\Branch;
use App\Facades\Branch as BranchFacade;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Section;

class BranchController extends Controller
{
    public function index()
    {
        //
    }

    public function create(): Response
    {
        return Inertia::render('Branch/Create', ['sections' => SectionResource::collection(SectionFacade::getSections([], ['id', 'title']))]);
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        BranchFacade::store($request->branchData());
        return redirect()->route('sections.index');
    }

    public function show(Branch $branch)
    {
        return Inertia::render('Branch/Show', ['branch' => BranchWithChildrenResource::make($branch)]);
    }

    public function edit(Branch $branch)
    {
        $sections = SectionWithBranchesResource::collection(SectionFacade::getSections(['branches']));
        return Inertia::render('Branch/Update', ['sections' => $sections, 'branch' => $branch]);
    }

    public function update(UpdateRequest $request, Branch $branch)
    {
        BranchFacade::update($request->branchData(), $branch);
        return redirect()->route('sections.index');
    }

    public function destroy(Branch $branch)
    {
        $branch->delete();

        return redirect()->route('sections.index');
    }

    public function branchIndex(Section $section): AnonymousResourceCollection
    {
        return BranchResource::collection(BranchFacade::getBranches([], ['id', 'title'], $section));
    }

    public function branchIndexExtract(Section $section, Branch $branch): AnonymousResourceCollection
    {
        return BranchResource::collection($section->getOtherBranches($branch));
    }

    public function themeCreate(Branch $branch)
    {
        return Inertia::render('Theme/Create', ['branch' => BranchResource::make($branch)]);
    }
}
