<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Series;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        $series = Series::all();
        $messageSuccess = $request->session()->get("message.success");
        return view("series.index")
            ->with("series", $series)
            ->with("messageSuccess", $messageSuccess);
    }

    public function create()
    {
        return view("series.create");
    }

    public function store(SeriesFormRequest $request)
    {
        $serie = Series::create($request->all());
        $seasons = [];
        for ($i = 1; $i <= $request->seasons; $i++) {
            $seasons[] = [
                "series_id" => $serie->id,
                "number" => $i
            ];
        }
        Season::insert($seasons);

        $episodes = [];
        foreach ($serie->seasons as $season) {
            for ($j = 0; $j <= $request->episodesPerSeason; $j++) {
                $episodes[] = [
                    'season_id' => $season->id,
                    'number' => $j
                ];
            }
        }
        Episode::insert($episodes);

        return to_route("series.index")
            ->with("message.success", "Série '{$serie->name}' criada com sucesso");
    }

    public function destroy(Series $series, Request $request)
    {
        $series->delete();
        return to_route("series.index")
            ->with("message.success", "Série '{$series->name}' removida com sucesso");
    }

    public function edit(Series $series)
    {
        return view("series.edit")->with("serie", $series);
    }

    public function update(Series $series, SeriesFormRequest $request)
    {
        $series->fill($request->all());
        $series->save();
        return to_route("series.index")
            ->with('message.success', "Série '{$series->name}' editada com sucesso");
    }
}
