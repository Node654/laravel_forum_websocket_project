<?php

namespace App\Http\Controllers\Admin;

use App\Facades\Notification;
use App\Http\Controllers\Controller;
use App\Http\Resources\Complaint\ComplaintResource;
use App\Models\Complaint;
use Inertia\Inertia;
use Inertia\Response;

class ComplaintController extends Controller
{
    public function index(): Response
    {
         $complaints = Complaint::all();
        return Inertia::render('Admin/Complaint/Index', ['complaints' => ComplaintResource::collection($complaints)]);
    }

    public function update(Complaint $complaint): ComplaintResource
    {
        $complaint->update([
            'is_solved' => ! $complaint->is_solved,
        ]);

        $title = $complaint->is_solved ? 'Ваша жалоба рассмотрена!' : 'Ваша жалоба в работе!';

        Notification::store($complaint->message, $title, $complaint->user_id);

        return ComplaintResource::make($complaint);
    }
}
