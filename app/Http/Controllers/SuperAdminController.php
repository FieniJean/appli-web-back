<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function index()
    {
        $superadmins = User::where('role', 'superadmin')->get();

        return response()->json($superadmins);
    }

    public function create(Request $request)
    {
        $superadmin = new User;
        $superadmin->name = $request->input('name');
        $superadmin->email = $request->input('email');
        $superadmin->password = Hash::make($request->input('password'));
        $superadmin->role = 'superadmin';
        $superadmin->save();

        return response()->json(['message' => 'Super admin created'], 201);
    }

    public function update(Request $request, $id)
    {
        $superadmin = User::find($id);

        if (!$superadmin) {
            return response()->json(['message' => 'Super admin not found'], 404);
        }

        $superadmin->name = $request->input('name');
        $superadmin->email = $request->input('email');
        $superadmin->password = Hash::make($request->input('password'));
        $superadmin->save();

        return response()->json(['message' => 'Super admin updated'], 200);
    }

    public function delete($id)
    {
        $superadmin = User::find($id);

        if (!$superadmin) {
            return response()->json(['message' => 'Super admin not found'], 404);
        }

        $superadmin->delete();

        return response()->json(['message' => 'Super admin deleted'], 200);
    }
}
