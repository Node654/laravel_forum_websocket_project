<?php

namespace App\Http\Controllers\Message;

use App\Facades\Message as MessageFacade;
use App\Facades\Notification;
use App\Http\Controllers\Controller;
use App\Http\Requests\Complaint\StoreRequest as StoreComplaintRequest;
use App\Http\Requests\Message\StoreRequest;
use App\Http\Resources\Message\MessageWithUserResource;
use App\Models\Message;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageController extends Controller
{
    public function store(StoreRequest $request): JsonResource
    {
        $message = MessageFacade::store($request->messageData());

        return new MessageWithUserResource($message);
    }

    public function like(Message $message)
    {
        $res = $message->likes()->toggle(auth()->id());

        if ($res['attached']) {
            Notification::store($message, 'Вам поставили лайк!');
        }

        return new MessageWithUserResource($message);
    }

    public function storeComplaint(StoreComplaintRequest $request, Message $message): JsonResource
    {
        $message = MessageFacade::storeMessageComplaint($request->dataComplaint(), $message);

        return new MessageWithUserResource($message);
    }
}
