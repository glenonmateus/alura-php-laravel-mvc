<?php

use App\Http\Controllers\Api\EpisodesController;
use App\Http\Controllers\Api\SeasonsController;
use App\Http\Controllers\Api\SeriesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware("auth:sanctum")->get("/user", function (Request $request) {
    return $request->user();
});

Route::apiResource("/series", SeriesController::class);

Route::controller(SeasonsController::class)->group(function () {
    Route::get("/series/{series}/seasons", "index");
});

Route::controller(EpisodesController::class)->group(function () {
    Route::get("/series/{series}/episodes", "index");
    Route::patch("/episodes/{episode}", "update");
});
