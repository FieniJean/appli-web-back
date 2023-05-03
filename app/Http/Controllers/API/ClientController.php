<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Hash;
use App\Models\Client; //Import du modèle client
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\HasApiTokens;

class ClientController extends Controller
{
    use ValidatesRequests, HasApiTokens;

    /**
     * Affiche tous les clients
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all(); //Récupération de tous les clients
        return response()->json($clients); //Retourne une réponse au format JSON
    }

    /**
     * Créer un nouveau client.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $client = new Client;
        $client->nom_client = $request->nom_client;
        $client->statut_client = $request->statut_client;
        $client->prenom_client = $request->prenom_client;
        $client->email_client = $request->email_client;
        $client->password_client = Hash::make($request->password_client);
        $client->adresse_client = $request->adresse_client;
        $client->telephone_client = $request->telephone_client;
        $client->save();
        return response()->json($client);
    }

    /**
     * Afficher un client.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::findOrFail($id);
        return response()->json($client);
    }

    /**
     * Mettre à jour un client.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);
        $client->nom_client = $request->nom_client;
        $client->statut_client = $request->statut_client;
        $client->prenom_client = $request->prenom_client;
        $client->email_client = $request->email_client;
        $client->password_client = Hash::make($request->password_client);
        $client->adresse_client = $request->adresse_client;
        $client->telephone_client = $request->telephone_client;
        $client->save();
        return response()->json($client);
    }

    /**
     * Supprimer un client.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();
        return response()->json('Client supprimé avec succès.');
    }
    /// Search a client API
    public function search($nom_technicien)
    {
        return Client::where("nom_technician", "like", "%" . $nom_technicien . "%")->get();
    }


    // Register a new client

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom_client' => 'required|string|max:255',
            'email_client' => 'required|string|email|max:255|unique:clients',
            'password_client' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $client = new Client([
            'nom_client' => $request->nom_client,
            'email_client' => $request->email_client,
            'password_client' => Hash::make($request->password_client),
            'statut_client' => $request->statut_client,
            'prenom_client' => $request->prenom_client,
            'adresse_client' => $request->adresse_client,
            'telephone_client' => $request->telephone_client
        ]);
        $client->save();

        $token = $client->createToken('ClientToken')->plainTextToken;

        return response()->json([
            'message' => 'Client enregistré avec succès.',
            'client' => $client,
            'token' => $token
        ]);
    }

    // Login client

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email_client' => 'required|string|email',
            'password_client' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $client = Client::where('email_client', $request->email_client)->first();

        if (!$client || !Hash::check($request->password_client, $client->password_client)) {
            throw ValidationException::withMessages([
                'email_client' => ['Les informations d\'identification sont incorrectes.'],
            ]);
        }

        $token = $client->createToken('ClientToken')->plainTextToken;

        return response()->json([
            'message' => 'Client connecté avec succès.',
            'client' => $client,
            'token' => $token
        ]);
    }

    // Logout client

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Client déconnecté avec succès.']);
    }
}
