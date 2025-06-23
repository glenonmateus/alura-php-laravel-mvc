<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Episode;
use App\Models\Season;
use App\Models\Series;

use function Pest\Laravel\get;
use function Pest\Laravel\patchJson;

test("get episodes from series", function () {
    $series = Series::factory()
        ->has(
            Season::factory()
                ->count(3)
                ->has(Episode::factory()->count(3))
        )
        ->create();
    get("/api/series/{$series->id}/episodes")
        ->assertStatus(200)
        ->assertHeader("Content-Type", "application/json")
        ->assertJsonCount(9);
});

test("patch episodes watched", function () {
    $series = Series::factory()
        ->has(
            Season::factory()
                ->count(3)
                ->has(Episode::factory()->count(3))
        )
        ->create();
    $episode = $series->episodes()->where("watched", false)->first();
    patchJson("/api/episodes/{$episode->id}", [
        "watched" => true,
    ])->assertStatus(200);
});
