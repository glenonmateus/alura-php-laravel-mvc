<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Episode;
use App\Models\Season;
use App\Models\Series;

use function Pest\Laravel\get;

test(
    "get season from series",
    function () {
        $series = Series::factory()
            ->has(
                Season::factory()
                    ->count(3)
                    ->has(Episode::factory()->count(3))
            )
            ->create();

        get("/api/series/{$series->id}/seasons")
            ->assertOk()
            ->assertHeader("Content-Type", "application/json")
            ->assertJsonCount(3)
            ->assertJsonStructure(
                [['id','number','series_id','created_at','updated_at']]
            );
    }
);

test(
    "not found series",
    function () {
        get("/api/series/0/seasons")
            ->assertNotFound()
            ->assertJsonStructure(
                ['message']
            );
    }
);
