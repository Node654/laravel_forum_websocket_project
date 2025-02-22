<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
