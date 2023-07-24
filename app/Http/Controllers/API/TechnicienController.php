<?php

namespace App\Http\Controllers\API;

use App\Models\Technicien;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class TechnicienController extends Controller
{
    /**
     * Display a listing of the technicien.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $techniciens = Technicien::all();
        return response()->json($techniciens);
        //
    }

    // /**
    //  * Show the form for creating a new technicians.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created technician in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $technicien = new Technicien();
        $technicien->photo_technicien = $request->photo_technicien;
        $technicien->nom_technicien = $request->nom_technicien;
        $technicien->prenom_technicien = $request->prenom_technicien;
        $technicien->email_technicien = $request->email_technicien;
        $technicien->password_technicien = Hash::make($request->password_technicien);
        $technicien->adresse_technicien = $request->adresse_technicien;
        $technicien->telephone_technicien = $request->telephone_technicien;
        $technicien->save();
        return response()->json($technicien);
        //
    }

    /**
     * Display the specified technician.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $technicien = Technicien::find($id);
        return response()->json($technicien);
        //
    }

    // /**
    //  * Show the form for editing the specified technicien.
    //  *
    //  * @param  \App\Models\Client  $client
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(Technicien $technicien)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $technicien = Technicien::find($id);
        $technicien->photo_technicien = $request->photo_technicien;
        $technicien->nom_technicien = $request->nom_technicien;
        $technicien->prenom_technicien = $request->prenom_technicien;
        $technicien->email_technicien = $request->email_technicien;
        $technicien->password_technicien = Hash::make($request->password_technicien);
        $technicien->adresse_technicien = $request->adresse_technicien;
        $technicien->telephone_technicien = $request->telephone_technicien;
        $technicien->save();
        return response()->json($technicien);

        //
    }

    /**
     * Remove the specified technician from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $technicien = Technicien::find($id);
        $technicien->delete();
        return response()->json('Technicien supprimé avec succès.');

        //
    }


    //Register a new technician

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom_technicien' => 'required|string|max:255',
            'email_technicien' => 'required|string|email|max:255|unique:techniciens',
            'password_technicien' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $technicien = new Technicien([
            'nom_technicien' => $request->nom_technicien,
            'email_technicien' => $request->email_technicien,
            'password_technicien' => Hash::make($request->password_technicien),
        ]);

        $technicien->save();

        $token = $technicien->createToken('ClientToken')->plainTextToken;


        return response()->json([
            'message' => 'Successfully registered',
            'technicien' => $technicien,
            'token' => $token


        ]);
    }

    //Search technician by name

    public function search($nom_technicien)
    {
        return Technicien::where("nom_technicien", "like", "%" . $nom_technicien . "%")->get();
    }


    //login of new technician

    // Log in technicien
    public function login(Request $request)
    {
        $credentials = $request->only('email_technicien', 'password_technicien');

        if (Auth::attempt($credentials)) {
            $token = $request->user('technicien')->createToken('API Token')->accessToken;

            return response()->json(['token' => $token]);
        } else {
            return response()->json(['error' => 'Invalid login credentials'], 401);
        }
    }

    // Log out technicien
    public function logout(Request $request)
    {
        $request->user('technicien')->token()->revoke();

        return response()->json(['message' => 'Successfully logged out']);
    }

    //Rest password
    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email_technicien' => 'required|string|email|max:255',
            'password_technicien' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $technicien = Technicien::where('email_technicien', $request->email_technicien)->first();

        if (!$technicien) {
            return response()->json(['error' => 'Invalid email address'], 404);
        }

        $technicien->password_technicien = Hash::make($request->password_technicien);
        $technicien->save();

        return response()->json(['message' => 'Successfully reset password']);
    }
}
