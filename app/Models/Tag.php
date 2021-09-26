<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use SoftDeletes;

    public function bits(): HasMany
    {
        return $this->hasMany(Bit::class)
                    ->whereNull('parent_id')
                    ->where('active', 1)
                    ->orderBy('position');
    }

    public function scopeHome($query)
    {
        return $query->where('home', 1);
    }

    public function parentTag(): BelongsTo
    {
        return $this->belongsTo(Tag::class, 'parent_id');
    }

    public function childrenTags(): HasMany
    {
        return $this->hasMany(Tag::class, 'parent_id')
                    ->where('active', 1)
                    ->orderBy('position', 'asc');
    }
}
