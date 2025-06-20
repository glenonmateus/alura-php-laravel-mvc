<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Episode;
use App\Models\Season;
use App\Models\Series;
use function Pest\Laravel\get;

test("list all series", function () {
    $series = Series::factory()
        ->has(
            Season::factory()
                ->count(3)
                ->has(Episode::factory()->count(3))
        )
        ->create();
    $data = [
        [
            "name" => $series->name,
            "created_at" => $series->created_at->toIsoString(),
            "updated_at" => $series->updated_at->toIsoString(),
            "cover" => $series->cover,
        ],
    ];
    get("/api/series/")
        ->assertStatus(200)
        ->assertHeader("Content-Type", "application/json")
        ->assertJson($data)
        ->assertJsonCount(1);
});
