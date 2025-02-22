<?php

namespace App\Models;

use Database\Factories\BranchFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    /** @use HasFactory<BranchFactory> */
    use HasFactory;

    use SoftDeletes;

    protected $table = 'branches';

    protected $fillable = [
        'title',
        'section_id',
        'parent_id',
    ];

    public function children(): HasMany
    {
        return $this->hasMany(Branch::class, 'parent_id', 'id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'parent_id', 'id');
    }

    public function themes(): HasMany
    {
        return $this->hasMany(Theme::class, 'branch_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
