<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Mail\SeriesCreated;
use App\Models\Series;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Repositories\SeriesRepository;
use Illuminate\Support\Facades\Mail;

class SeriesController extends Controller
{
    public function __construct(
        private SeriesRepository $repository
    ) {
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
        $serie = $this->repository->add($request);
        $userList = User::all();
        foreach ($userList as $user) {
            $email = new SeriesCreated(
                $serie->name,
                $serie->id,
                $request->seasons,
                $request->episodesPerSeason
            );
            Mail::to($user)->send($email);
        }
        return to_route("series.index")->with(
            "message.success",
            "Série '{$serie->name}' criada com sucesso"
        );
    }

    public function destroy(Series $series, Request $request): RedirectResponse
    {
        $series->delete();
        return to_route("series.index")->with(
            "message.success",
            "Série '{$series->name}' removida com sucesso"
        );
    }

    public function edit(Series $series): View
    {
        return view("series.edit")->with("serie", $series);
    }

    public function update(Series $series, SeriesFormRequest $request): RedirectResponse
    {
        $series->fill($request->all());
        $series->save();
        return to_route("series.index")->with(
            "message.success",
            "Série '{$series->name}' editada com sucesso"
        );
    }
}
