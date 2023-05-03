<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoleController extends Controller

{


    // ...

    public function assignRole(User $user, Role $role)
    {
        // Attacher le rôle à l'utilisateur
        $user->roles()->attach($role);
        return redirect()->back()->with('success message', "Le rôle a été attribué à l'utilisateur avec succès.");
    }

    //Search UserByRole

    public function search($role)
    {

        return User::where("role", "like", "%" . $role . "%")->get();
    }
}
