<?php

namespace App\Http\Controllers\API;

use App\Models\Extincteur;
use App\Http\Controllers\Controller;
// use App\Models\Client;
use Illuminate\Http\Request;

class ExtincteurController extends Controller
{
    /**
     * Display a listing of the extinguisher.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $extincteurs = Extincteur::all(); //Récupérations de tous les extincteur

        return response()->json($extincteurs); //Rétourne une reponse au format JSON
        //
    }

    /**
     * Store a newly created extinguisher in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $extincteur = new Extincteur;
        $extincteur->numero_extincteur = $request->numero_extincteur;
        $extincteur->date_creation = $request->date_creation;
        $extincteur->date_expiration = $request->date_expiration;
        $extincteur->categorie_id = $request->categorie_id;
        $extincteur->site_id = $request->site_id;
        $extincteur->save();
        return response()->json($extincteur);


        //
    }

    /**
     * Display the specified extinguisher.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $extincteur = Extincteur::find($id);
        return response()->json($extincteur);
        //
    }

    /**
     * Update the specified extinguisher in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $extincteur = Extincteur::find($id);
        $extincteur->numero_extincteur = $request->numero_extincteur;
        $extincteur->date_creation = $request->date_creation;
        $extincteur->date_expiration = $request->date_expiration;
        $extincteur->categorie_id = $request->categorie_id;
        $extincteur->site_id = $request->site_id;
        $extincteur->save();
        return response()->json($extincteur);
        //
    }

    /**
     * Remove the specified extinguisher from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $extincteur = Extincteur::find($id);
        $extincteur->delete();
        return response()->json('Extincteur supprimé avec succès.');
    }
    //

}
