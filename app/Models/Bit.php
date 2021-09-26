<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Bit extends Model implements HasMedia
{
    use InteractsWithMedia, SoftDeletes;

    public function tag(): BelongsTo
    {
        return $this->belongsTo(Tag::class);
    }

    public function bitTheme(): BelongsTo
    {
        return $this->belongsTo(BitTheme::class);
    }

    public function childrenBits(): HasMany
    {
        return $this->hasMany(Bit::class, 'parent_id')
                    ->orderBy('position');
    }
}
