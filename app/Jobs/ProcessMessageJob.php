<?php

namespace App\Jobs;

use App\Facades\Notification;
use App\Models\Image;
use App\Models\Message;
use App\Models\User;
use App\Services\Message\DTO\StoreMessageData;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessMessageJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(private StoreMessageData $data, private Message $message)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $ids = User::getFilteredUserId($this->data);
        $imgIds = getImgIds($this->data);

        Image::updateMessageId($imgIds, $this->message);
        Image::cleanStorage();
        Image::cleanMessageId();

        $this->message->answeredUsers()->attach($ids);

        $ids->each(function (int $answeredUserId) {
            Notification::store($this->message, 'Вам ответили!', $answeredUserId);
        });
    }
}
