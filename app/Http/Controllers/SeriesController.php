<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use Illuminate\Http\Request;
use App\Repositories\SeriesRepository;

class SeriesController extends Controller
{
    public function __construct(private SeriesRepository $repository) {}

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
        $serie = $this->repository->add($request);
        return to_route("series.index")->with(
            "message.success",
            "Série '{$serie->name}' criada com sucesso"
        );
    }

    public function destroy(Series $series, Request $request)
    {
        $series->delete();
        return to_route("series.index")->with(
            "message.success",
            "Série '{$series->name}' removida com sucesso"
        );
    }

    public function edit(Series $series)
    {
        return view("series.edit")->with("serie", $series);
    }

    public function update(Series $series, SeriesFormRequest $request)
    {
        $series->fill($request->all());
        $series->save();
        return to_route("series.index")->with(
            "message.success",
            "Série '{$series->name}' editada com sucesso"
        );
    }
}
