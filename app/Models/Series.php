<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    use HasFactory;
    protected $fillable = ["name", "cover"];

    public function seasons()
    {
        return $this->hasMany(Season::class, 'series_id');
    }

    public static function booted()
    {
        self::addGlobalScope(
            'ordered',
            function (Builder $builder) {
                $builder->orderBy('name', 'asc');
            }
        );
    }
}
