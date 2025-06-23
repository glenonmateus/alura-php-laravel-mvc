<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Series extends Model
{
    use HasFactory;
    protected $fillable = ["name", "cover"];
    protected $appends = ["links"];

    public function seasons(): HasMany
    {
        return $this->hasMany(Season::class, "series_id");
    }

    public function episodes(): HasManyThrough
    {
        return $this->hasManyThrough(Episode::class, Season::class);
    }

    public static function booted(): void
    {
        self::addGlobalScope("ordered", function (Builder $builder) {
            $builder->orderBy("name", "asc");
        });
    }

    public function links(): Attribute
    {
        return new Attribute(
            get: fn() => [
                [
                    "rel" => "self",
                    "url" => route("series.show", $this),
                ],
                [
                    "rel" => "seasons",
                    "url" => route("seasons.index", $this),
                ],
                [
                    "rel" => "episodes",
                    "url" => route("episodes.index", $this),
                ],
            ]
        );
    }
}
