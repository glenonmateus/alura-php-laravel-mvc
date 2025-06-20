<?php

use App\Models\Episode;
use App\Models\Season;
use App\Models\Series;

test(
    "test when a serie is created its seasons and episodes must also be created",
    function () {
        $series = Series::factory()
            ->has(
                Season::factory()
                    ->count(3)
                    ->has(Episode::factory()->count(3))
            )
            ->create();
        expect($series)->toBeInstanceOf(Series::class);
        expect($series->seasons)->toHaveCount(3);
        expect($series->episodes)->toHaveCount(9);
    }
);
