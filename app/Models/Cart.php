<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    protected $guarded = [];

    public function bit(): BelongsTo
    {
        return $this->belongsTo(Bit::class);
    }

    public function getCartItemPriceAttribute(): int
    {
        return $this->bit->price * $this->quantity;
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
