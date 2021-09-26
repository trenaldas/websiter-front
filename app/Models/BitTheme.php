<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class BitTheme extends Model
{
    use SoftDeletes;

    public function bit(): HasMany
    {
        return $this->hasMany(Bit::class);
    }
}
