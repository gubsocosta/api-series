<?php

namespace App\Http\Controllers;

use App\Models\Serie;

class SeriesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        return Serie::all();
    }
}
