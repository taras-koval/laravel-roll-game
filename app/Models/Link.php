<?php

namespace App\Models;

use Database\Factories\LinkFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Link extends Model
{
    /** @use HasFactory<LinkFactory> */
    use HasFactory;

    protected $fillable = [
        'uuid',
        'user_id',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    protected $attributes = [
        'active' => true,
    ];

    protected static function booted(): void
    {
        static::creating(function ($link) {
            $link->uuid = (string) Str::uuid();
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function rolls(): HasMany
    {
        return $this->hasMany(Roll::class);
    }

    public function isValid(): bool
    {
        return $this->active && $this->created_at->gt(now()->subDays(7));
    }
}
