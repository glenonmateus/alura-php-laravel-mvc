<?php

use App\Models\Episode;
use App\Models\Season;
use App\Models\Series;
use Carbon\Carbon;

test(
    'example',
    function () {
        $series = Series::factory()
            ->has(
                Season::factory()->count(3)->has(
                    Episode::factory()->count(3)
                )
            )->create();
        $response = $this->get("/api/series/");
        $data = [
            [
                'name' => $series->name,
                'created_at' => $series->created_at->toIsoString(),
                'updated_at' => $series->updated_at->toIsoString(),
                'cover' => $series->cover
            ]
        ];
        $response
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertJson($data);
    }
);
