<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Episode;
use App\Models\Season;
use App\Models\Series;

use function Pest\Laravel\get;

test(
    "list all series",
    function () {
        $series = Series::factory()
            ->has(
                Season::factory()
                    ->count(3)
                    ->has(Episode::factory()->count(3))
            )
            ->create();
        get("/api/series/")
            ->assertOk()
            ->assertHeader("Content-Type", "application/json")
            ->assertJsonStructure(
                [['id', 'name', 'cover', 'seasons']]
test(
    'delete series',
    function () {
        $series = Series::factory()
            ->has(
                Season::factory()
                    ->count(3)
                    ->has(Episode::factory()->count(3))
            )
            ->create();
        $user = User::factory()->create();
        $response = $this->actingAs($user)->deleteJson(
            "/api/series/" . $series->id
        );
        $response->assertNoContent();
    }
);

