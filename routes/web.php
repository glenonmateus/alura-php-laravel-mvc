<?php

use App\Http\Controllers\EpisodesController;
use App\Http\Controllers\SeasonsController;
use App\Http\Controllers\SeriesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get(
    '/',
    function () {
        return redirect('/series');
    }
);

Route::resource(
    "/series",
    SeriesController::class
);

Route::get(
    '/series/{series}/seasons',
    [SeasonsController::class,'index']
)->name('seasons.index');

Route::controller(EpisodesController::class)->group(
    function () {
        Route::get(
            '/seasons/{season}/episodes',
            'index'
        )->name('episodes.index');

        Route::post(
            '/seasons/{season}/episodes',
            'index'
        )->name('episodes.index');

        Route::post(
            '/seasons/{season}/episodes',
            'update'
        )->name('episodes.update');
    }
);
