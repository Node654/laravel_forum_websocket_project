<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Message extends Model
{
    /** @use HasFactory<\Database\Factories\MessageFactory> */
    use HasFactory;

    protected $fillable = [
        'body',
        'user_id',
        'theme_id',
    ];

//    public function getIsNotSolvedComplaintAttribute(): bool
//    {
//        return $this->complaintedUsers()
//            ->where('user_id', auth()->id())
//            ->where('is_solved', false)
//            ->exists();
//    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'message_user_likes', 'message_id', 'user_id');
    }
//
//    public function getIsLikedAttribute(): bool
//    {
//        return $this->likes()->where('user_id', auth()->id())->exists();
//    }

    public function answeredUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'message_user_answers', 'message_id', 'user_id', 'id', 'id');
    }

    public function complaintedUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'complaints', 'message_id', 'user_id', 'id', 'id');
    }
}
