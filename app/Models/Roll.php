<?php

namespace App\Models;

use Database\Factories\RollFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Roll extends Model
{
    /** @use HasFactory<RollFactory> */
    use HasFactory;

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
