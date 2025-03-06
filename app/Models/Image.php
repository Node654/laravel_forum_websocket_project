<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    protected $table = 'images';

    protected $fillable = [
        'path',
        'user_id',
    ];

    public function getUrlAttribute(): string
    {
        return url('storage/'.$this->path);
    }

    public function scopeUpdateMessageId(Builder $builder, Collection $imgIds, Message $message): void
    {
        $builder->whereIn('id', $imgIds)->update([
                'message_id' => $message->id,
            ]);
    }

    public function scopeCleanStorage(Builder $builder): void
    {
        $builder->where('user_id', auth()->id())
            ->whereNull('message_id')
            ->get()
            ->pluck('path')
            ->each(function ($path) {
                Storage::disk('public')->delete($path);
            });
    }

    public function scopeCleanMessageId(Builder $builder)
    {
        $builder->where('user_id', auth()->id())
            ->whereNull('message_id')
            ->delete();
    }
}
