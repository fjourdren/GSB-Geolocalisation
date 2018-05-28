<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Location;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add($imei, $longitude, $latitude)
    {
      // Si le numéro IMEI existe déjà dans une localisation
      if (Location::where('imei',$imei)->first()){
        // Je selectionne la localisation
        $location = Location::where('imei',$imei)->first();
        // Je la suprime de la base de données
        $location->delete();
      }
      // Création d'une autre localisation
      $location = new Location();
      // On renseigne les propriétés
      $location->imei = $imei;
      $location->longitude = $longitude;
      $location->latitude = $latitude;
      // Sauvegarde sur la base de données
      $location->save();
      // Réponse Json
      return response()->json([
        'imei' => $imei,
        'longitude' => $longitude,
        'latitude' => $latitude
        'location'
      ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
    }
}
