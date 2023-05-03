<?php

namespace App\Http\Controllers\API;

use App\Models\Contrat;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ContratController extends Controller
{
    /**
     * Display a listing of the contract.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contrats = Contrat::all(); //
        return response()->json($contrats);
        //
    }

    /**
     * Add a new contract in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $contrat = new Contrat;
        $contrat->date_debut = $request->date_debut;
        $contrat->date_fin = $request->date_fin;
        $contrat->clause = Hash::make($request->clause);
        $contrat->save();
        return response()->json($contrat);

        //
    }

    /**
     * Display the specified contract.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contrat = Contrat::findOrFail($id);
        return response()->json($contrat);
        //
    }

    /**
     * Update the specified contract in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $contrat = Contrat::findOrFail($id);

        $contrat->date_debut = $request->date_debut;
        $contrat->date_fin = $request->date_fin;
        $contrat->clause = Hash::make($request->clause);
        $contrat->save();
        return response()->json($contrat);

        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contrat = Contrat::findOrFail($id);
        $contrat->delete();
        return response()->json('Contrat supprimé avec succès.');
    }
}
