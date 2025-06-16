<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\UsersController;
use App\Mail\SeriesCreated;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get(
    "/email",
    function () {
        return new SeriesCreated(
            'Série de teste',
            1,
            5,
            10
        );
    }
);

Route::get(
    "/",
    function () {
        return view("welcome");
    }
);

Route::get(
    "/dashboard",
    function () {
        return view("dashboard");
    }
)
    ->middleware(["auth", "verified"])
    ->name("dashboard");

Route::middleware("auth")->group(
    function () {
        Route::get("/profile", [ProfileController::class, "edit"])->name(
            "profile.edit"
        );
        Route::patch("/profile", [ProfileController::class, "update"])->name(
            "profile.update"
        );
        Route::delete("/profile", [ProfileController::class, "destroy"])->name(
            "profile.destroy"
        );
    }
);

Route::resource("/series", SeriesController::class);

Route::get("/login", [LoginController::class, "index"])->name("login");
Route::post("/login", [LoginController::class, "store"])->name("sigin");
Route::get("/logout", [LoginController::class, "destroy"])->name("logout");

Route::get("/register", [UsersController::class, "create"])->name(
    "users.create"
);
Route::post("/register", [UsersController::class, "store"])->name(
    "users.store"
);
require __DIR__ . "/auth.php";
