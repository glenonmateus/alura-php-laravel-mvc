<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index()
    {
        $series = ["Punisher", "Lost", "Grey"];
        return view("series.index")->with("series", $series);
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(Request $request)
    {
        $name = $request->input('name');
    }
}
