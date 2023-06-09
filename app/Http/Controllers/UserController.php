<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use Illuminate\Foundation\Auth\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\Return_;

class UserController extends Controller
{
    ///Serach user by name
    public function search($name)
    {
        return User::where("name", "like", "%" . $name . "%")->get();
    }

    public function index(Request $request)
    {
        $users = User::all();
        return response()->json([
            'status' => 200,
            'users' => $users,
        ]);
    }
}
// class AuthController extends Controller
// {
//     public function register(Request $request)
//     {
//         $validated = $request->validate([
//             'name' => 'required|string|max:255',
//             'email' => 'required|string|email|max:255|unique:users',
//             'password' => 'required|string|min:8|confirmed',
//         ]);

//         $user = User::create([
//             'name' => $validated['name'],
//             'email' => $validated['email'],
//             'password' => Hash::make($validated['password']),
//         ]);

//         $token = $user->createToken('API Token')->plainTextToken;

//         return response()->json([
//             'message' => 'User created successfully.',
//             'token' => $token,
//         ]);
//     }

//     public function login(Request $request)
//     {
//         $validated = $request->validate([
//             'email' => 'required|string|email|max:255',
//             'password' => 'required|string|min:8',
//         ]);

//         if (!Auth::attempt($validated)) {
//             return response()->json([
//                 'message' => 'Invalid credentials.'
//             ], 401);
//         }

//         $token = $request->user('user')->createToken('API Token')->accessToken;

//         return response()->json([
//             'message' => 'User logged in successfully.',
//             'token' => $token,
//         ]);
//     }

//     public function logout(Request $request)
//     {
//         $request->user()->tokens()->delete();

//         return response()->json([
//             'message' => 'User logged out successfully.',
//         ]);
//     }
// }
