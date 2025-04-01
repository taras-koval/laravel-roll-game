<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Roll extends Model
{
    protected $fillable = [
        'link_id',
        'number',
        'win',
        'amount',
    ];

    public function link(): BelongsTo
    {
        return $this->belongsTo(Link::class);
    }
}
