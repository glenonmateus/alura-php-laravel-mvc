<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Episode
 * @package App\Models
 * @mixin Builder
 */
class Episode extends Model
{
    use HasFactory;
    protected $fillable = ["number"];
    protected $casts = [
        "watched" => "boolean",
    ];

    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }

    public function scopeWatched(Builder $query): void
    {
        $query->where("watched", true);
    }
}
