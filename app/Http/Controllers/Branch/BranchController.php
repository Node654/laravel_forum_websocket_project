<?php

namespace App\Http\Controllers\Branch;

use App\Facades\Section as SectionFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\Branch\StoreRequest;
use App\Http\Resources\Branch\BranchResource;
use App\Http\Resources\Section\SectionResource;
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
        BranchFacade::store($request->data());
        return redirect()->route('sections.index');
    }

    public function show(Branch $branch)
    {
        return Inertia::render('Branch/Show', ['branch' => $branch]);
    }

    public function edit(Branch $branch)
    {
        //
    }

    public function update(Request $request, Branch $branch)
    {
        //
    }

    public function destroy(Branch $branch)
    {
        //
    }

    public function branchIndex(Section $section): AnonymousResourceCollection
    {
        return BranchResource::collection(BranchFacade::getBranches([], ['id', 'title'], $section));
    }
}
