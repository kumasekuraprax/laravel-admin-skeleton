<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{

    /* Constructor */
    public function __construct()
    {
        # code...
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.index');
    }
}
