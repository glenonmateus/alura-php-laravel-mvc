<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Episode;
use App\Models\Season;
use App\Models\Series;
use App\Models\User;

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
        $user = User::factory()->create();
        $response = $this->actingAs($user)->getJson("/api/series/");
        $response->assertOk();
    }
);

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

test(
    "create series",
    function () {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->postJson(
            "/api/series/",
            ["name" => "test", "seasons" => 1, "episodesPerSeason" => 1]
        );
        $response->assertStatus(201);
    }
);
