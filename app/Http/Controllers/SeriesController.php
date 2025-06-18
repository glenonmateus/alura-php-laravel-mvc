<?php

namespace App\Http\Controllers;

use App\Events\SeriesCreatedEvent;
use App\Events\DeleteSeriesCoverEvent;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Repositories\SeriesRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File;

class SeriesController extends Controller
{
    public function __construct(private SeriesRepository $repository)
    {
    }

    public function index(Request $request): View
    {
        $series = Series::all();
        $messageSuccess = $request->session()->get("message.success");
        return view("series.index")
            ->with("series", $series)
            ->with("messageSuccess", $messageSuccess);
    }

    public function create(): View|Factory
    {
        return view("series.create");
    }

    public function store(SeriesFormRequest $request): RedirectResponse
    {
        Validator::validate($request->all(), [ 'cover' => [ File::image() ] ]);
        $cover = $request->hasFile('cover') ? $request->cover->store("covers", "public") : null;
        $request->cover = $cover;
        $serie = $this->repository->add($request);
        SeriesCreatedEvent::dispatch(
            $serie->name,
            $serie->id,
            $request->seasons,
            $request->episodesPerSeason,
        );
        return to_route("series.index")->with(
            "message.success",
            "Série '{$serie->name}' criada com sucesso"
        );
    }

    public function destroy(Series $series): RedirectResponse
    {
        $series->delete();
        DeleteSeriesCoverEvent::dispatch($series->cover);
        return to_route("series.index")->with(
            "message.success",
            "Série '{$series->name}' removida com sucesso"
        );
    }

    public function edit(Series $series): View
    {
        return view("series.edit")->with("serie", $series);
    }

    public function update(
        Series $series,
        SeriesFormRequest $request
    ): RedirectResponse {
        $series->fill($request->all());
        $series->save();
        return to_route("series.index")->with(
            "message.success",
            "Série '{$series->name}' editada com sucesso"
        );
    }
}
