<?php

namespace App\Http\Controllers\API;

use App\Models\Site;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    /**
     * Display a listing of the Site.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $site = Site::all();
        return response()->json($site);
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $site = new Site;
        $site->nom_site = $request->nom_site;
        $site->adresse_site = $request->adresse_site;
        $site->longitude = $request->longitude;
        $site->latitude = $request->latitude;
        $site->client_id = $request->client_id;
        $site->save();
        return response()->json($site);
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $site = Site::findOrFail($id);
        return response()->json($site);
        //
    }

    /**
     * Update the specified site in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $site = Site::findOrFail($id);
        $site->nom_site = $request->nom_site;
        $site->adresse_site = $request->adresse_site;
        $site->longitude = $request->longitude;
        $site->latitude = $request->latitude;
        $site->client_id = $request->client_id;
        $site->save();
        return response()->json($site);
        //
    }

    /**
     * Remove the specified site from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $site = Site::findOrFail($id);
        $site->delete();
        return response()->json('Site supprimé avec succès.');
        //
    }

    //Search Site by name

    public function search($nom_site)
    {
        return Site::where("nom_site", "like", "%" . $nom_site . "%");
    }
}
