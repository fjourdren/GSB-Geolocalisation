<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Location;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {   // Obliger d'être authentifié pour accéder à la page
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // Selection de toutes les locations
      $locations = Location::all();
      // Retour de la vue avec les locations
      return view('home', ['locations' => $locations]);
    }
}
