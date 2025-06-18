<?php

use App\Models\Episode;
use App\Models\Season;
use App\Models\Series;

test(
    'test when a serie is created its seasons and episodes must also be created',
    function () {
        $series = Series::factory()
            ->has(
                Season::factory()->count(3)->has(
                    Episode::factory()->count(3)
                )
            )->create();
        $this->assertDatabaseHas(
            'series',
            ['id' => $series->id]
        );
        $this->assertDatabaseHas(
            'seasons',
            ['series_id' => $series->id]
        );
        $this->assertDatabaseHas(
            'episodes',
            ['season_id' => $series->seasons->first()->id]
        );
        $this->assertEquals(
            3,
            Season::where('series_id', $series->id)->count()
        );
        $this->assertEquals(
            3,
            Episode::where('season_id', $series->seasons->first()->id)->count()
        );
    }
);
