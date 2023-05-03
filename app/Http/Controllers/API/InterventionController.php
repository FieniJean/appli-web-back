<?php

namespace App\Http\Controllers\API;

use App\Models\Intervention;
use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class InterventionController extends Controller
{
    /**
     * Display a listing of Intervention.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $interventions = Intervention::all(); //Récupérations de toutes les interventions

        return response()->json($interventions); //Rétourne une reponse au format JSON

        //
    }

    /**
     * Store a newly created Interventions in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $intervention = new Intervention;
        $intervention->date_intervention = $request->date_intervention;
        $intervention->date_proch_intervention = $request->date_proch_intervention;
        $intervention->notes_intervention = $request->notes_intervention;
        $intervention->extincteur_id = $request->extincteur_id;
        $intervention->technicien_id = $request->technicien_id;
        $intervention->save();
        return response()->json($intervention);
        //
    }

    /**
     * Display the specified intervention.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $intervention = Intervention::findOrFail($id);
        return response()->json($intervention);
        //
    }

    /**
     * Update the specified Intervention in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $intervention = Intervention::findOrFail($id);
        $intervention->date_intervention = $request->date_intervention;
        $intervention->date_proch_intervention = $request->date_proch_intervention;
        $intervention->notes_intervention = $request->notes_intervention;
        $intervention->extincteur_id = $request->extincteur_id;
        $intervention->technicien_id = $request->technicien_id;
        $intervention->save();
        return response()->json($intervention);
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $intervention = Intervention::findOrFail($id);
        $intervention->delete();
        return response()->json('Intervention supprimée avec succès.');

        //
    }
}
