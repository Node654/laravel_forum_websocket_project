<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Complaint extends Model
{
    protected $table = 'complaints';

    protected $fillable = [
        'id',
        'body',
        'is_solved',
        'user_id',
        'message_id',
        'theme_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function message(): BelongsTo
    {
        return $this->belongsTo(Message::class, 'message_id','id');
    }
}
