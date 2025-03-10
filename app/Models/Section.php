<?php

namespace App\Models;

use Database\Factories\SectionFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    /** @use HasFactory<SectionFactory> */
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'title',
    ];

    protected $table = 'sections';

    public function branches(): HasMany
    {
        return $this->hasMany(Branch::class, 'section_id', 'id');
    }

    public function parentBranches(): HasMany
    {
        return $this->hasMany(Branch::class, 'section_id', 'id')
            ->whereNull('parent_id');
    }

    public function getOtherBranches(Branch $branch): Collection
    {
        return $this->branches()->whereNot('id', $branch->id)->get();
    }
}
