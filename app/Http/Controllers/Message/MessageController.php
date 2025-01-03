<?php

namespace App\Http\Controllers\Message;

use App\Facades\Message as MessageFacade;
use App\Http\Controllers\Controller;
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
        $message->likes()->toggle(auth()->id());
        return new MessageWithUserResource($message);
    }
}
