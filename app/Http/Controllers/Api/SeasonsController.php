<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Series;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SeasonsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \App\Models\Series $series Description
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Series $series): JsonResponse
    {
        return response()->json($series->seasons);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request Description
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): void
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id Description
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id): void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request Description
     * @param int                      $id      Description
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id): void
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id Description
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): void
    {
        //
    }
}
