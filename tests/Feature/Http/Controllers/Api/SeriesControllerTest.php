<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Episode;
use App\Models\Season;
use App\Models\Series;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->series = Series::factory()
        ->has(
            Season::factory()
                ->count(3)
                ->has(Episode::factory()->count(3))
        )
        ->create();
});

test(
    "list all series",
    function () {
        $response = $this->actingAs($this->user)->getJson("/api/series/");
        $response->assertOk();
    }
);

test(
    'delete series',
    function () {
        $response = $this->actingAs($this->user)->deleteJson(
            "/api/series/{$this->series->id}"
        );
        $response->assertNoContent();
    }
);

test(
    "create series",
    function () {
        $response = $this->actingAs($this->user)->postJson(
            "/api/series/",
            ["name" => "test", "seasons" => 1, "episodesPerSeason" => 1]
        );
        $response->assertCreated();
    }
);

test(
    "show 1 series",
    function () {
        $response = $this->actingAs($this->user)->getJson(
            "/api/series/{$this->series->id}"
        );
        $response->assertOk();
    }
);

test(
    "put series",
    function () {
        $response = $this->actingAs($this->user)->putJson(
            "/api/series/{$this->series->id}",
            ["name" => "teste"]
        );
        $response->assertOk();
        $this->assertDatabaseHas('series', ["name" => "teste"]);
    }
);
