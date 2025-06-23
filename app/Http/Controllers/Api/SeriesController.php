<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use App\Repositories\SeriesRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function __construct(public readonly SeriesRepository $repository)
    {
    }
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request Description
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): JsonResponse
    {
        if (!$request->has("name")) {
            return response()->json(
                Series::with("seasons.episodes")->paginate()
            );
        }
        return response()->json(
            Series::with("seasons.episodes")
                ->where("name", "like", "%{$request->name}%")
                ->paginate()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request Description
     *
     * @return \Illuminate\Http\Response
     */
    public function store(SeriesFormRequest $request): JsonResponse
    {
        return response()->json($this->repository->add($request), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id Description
     *
     * @return \Illuminate\Http\Response
     */
    public function show(int $id): JsonResponse|null
    {
        $series = Series::with("seasons.episodes")->find($id);
        if ($series === null) {
            return response()->json(["message" => "Series not found"], 404);
        }
        return response()->json($series);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request Description
     * @param int                      $id      Description
     *
     * @return \Illuminate\Http\Response
     */
    public function update(SeriesFormRequest $request, int $id): void
    {
        Series::where("id", $id)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id Description
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        Series::destroy($id);
        return response()->noContent();
    }
}
