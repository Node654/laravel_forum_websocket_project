<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Theme extends Model
{
    use SoftDeletes;

    protected $table = 'themes';

    protected $fillable = [
        'title',
        'description',
        'branch_id',
    ];

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class, 'theme_id', 'id');
    }
}
