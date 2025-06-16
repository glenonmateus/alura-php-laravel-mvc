<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Season;
use Illuminate\Http\Request;

class EpisodesController extends Controller
{
    public function index(Season $season)
    {
        return view(
            'episodes.index',
            [
                'episodes' => $season->episodes,
                'messageSuccess' => session('message.success')
            ]
        );
    }

    public function update(Request $request, Season $season)
    {
        $season->episodes->each(
            function (Episode $episode) use ($request) {
                $episode->watched = in_array(
                    $episode->id,
                    $request->episodes
                );
            }
        );
        $season->push();
        return to_route('episodes.index', $season->id)
            ->with('message.success', 'Episódios marcados com assistidos');
    }
}
