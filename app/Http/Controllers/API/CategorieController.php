<?php

namespace App\Http\Controllers\API;

use App\Models\Categorie;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    /**
     * Show all the categories of extinguisher.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Categorie::all(); // Get all categories
        return response()->json($categories); //return a JSON data

    }

    /**
     * Store a new categorie.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $categorie = new Categorie;
        $categorie->type_incendie = $request->type_incendie;
        $categorie->nom_extincteur = $request->nom_extincteur;
        $categorie->agent_extincteur = $request->agent_extincteur;
        $categorie->pression = $request->pression;
        $categorie->portee_max = $request->portee_max;
        $categorie->capacite = $request->capacite;
        $categorie->freq_entretien = $request->freq_entretien;
        $categorie->save();
        return response()->json($categorie);
    }

    /**
     * Display one categorie.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categorie = Categorie::find($id);
        return response()->json($categorie);
        //
    }

    /**
     * Update the specified categorie in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $categorie = Categorie::find($id);
        $categorie->type_incendie = $request->type_incendie;
        $categorie->nom_extincteur = $request->nom_extincteur;
        $categorie->agent_extincteur = $request->agent_extincteur;
        $categorie->pression = $request->pression;
        $categorie->portee_max = $request->portee_max;
        $categorie->capacite = $request->capacite;
        $categorie->freq_entretien = $request->freq_entretien;
        $categorie->save();
        return response()->json($categorie);
        //
    }

    /**
     * Remove the specified categorie from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categorie = Categorie::find($id);
        $categorie->delete();
        return response()->json('Catégorie supprimée avec succès.');
    }
}
