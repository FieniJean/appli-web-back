<?php

namespace App\Http\Controllers\API;

use App\Models\Souscription;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SouscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $souscription = Souscription::all();
        return response()->json($souscription);
        //
    }

    /**
     * Store a newly created Souscription in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $souscription = new Souscription;
        $souscription->date_souscriptions = $request->date_souscriptions;
        $souscription->client_id = $request->client_id;
        $souscription->contrat_id = $request->contrat_id;
        $souscription->save();
        return response()->json($souscription);
        //
    }

    /**
     * Display the specified Souscription.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $souscription = Souscription::find($id);
        return response()->json($souscription);
        //
    }

    /**
     * Update the specified Souscription in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $souscription = Souscription::find($id);
        $souscription->date_souscriptions = $request->date_souscriptions;
        $souscription->client_id = $request->client_id;
        $souscription->contrat_id = $request->contrat_id;
        $souscription->save();
        return response()->json($souscription);
        //
    }

    /**
     * Remove the specified souscription from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $souscription = Souscription::find($id);
        $souscription->delete();
        return response()->json('Souscription supprimée avec succès.');
        //
    }
}
