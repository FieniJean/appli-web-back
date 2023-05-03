<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $admins = User::where('role', 'admin')->get;
        return response()->json($admins);
    }

    public function create(Request $request)
    {
        $admin = new User;
        $admin->name = $request->input('name');
        $admin->email = $request->input('email');
        $admin->password = Hash::make($request->input('password'));
        $admin->role = 'admin';
        $admin->save();
        return response()->json(['message' => 'Admin created found'], 201);
    }

    public function update(Request $request, $id)
    {
        $admin = User::find($id);
        if (!$admin) {
            return response()->json(['message' => 'Admin not found'], 404);
        }
        $admin->name = $request->input('name');
        $admin->email = $request->input('email');
        $admin->password = Hash::make($request->input('password'));
        $admin->role = $request->input('role')->nullable;
        $admin->save();

        return response()->json(['message' => 'Admin updated'], 200);
    }
    public function delete($id)
    {
        $admin = User::find($id);

        if (!$admin) {
            return response()->json(['message' => 'Admin not found'], 404);
        }

        $admin->delete();

        return response()->json(['message' => 'Admin deleted'], 200);
    }
}
