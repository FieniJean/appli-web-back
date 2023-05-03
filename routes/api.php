<?php

use App\Http\Controllers\API\CategorieController;
use App\Http\Controllers\API\ClientController;
use App\Http\Controllers\API\ContratController;
use App\Http\Controllers\API\ExtincteurController;
use App\Http\Controllers\API\InterventionController;
use App\Http\Controllers\API\SiteController;
use App\Http\Controllers\API\SouscriptionController;
use App\Http\Controllers\API\TechnicienController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\UserController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



//Routes for registering, logging in, logging out, and resetting password of a client
Route::post('clients/register', 'App\Http\Controllers\API\ClientController@register');
Route::post('clients/login', 'App\Http\Controllers\API\ClientController@login');
Route::post('clients/logout', 'App\Http\Controllers\API\ClientController@logout')->middleware('auth:sanctum');
Route::post('clients/reset_password', 'App\Http\Controllers\API\ClientController@resetPassword');




//Routes for registering, logging in, logging out, and resetting password of a technicien
Route::post('techniciens/register', 'App\Http\Controllers\API\TechnicienController@register');
Route::post('techniciens/login', 'App\Http\Controllers\API\TechnicienController@login');
Route::post('techniciens/logout', 'App\Http\Controllers\API\TechnicienController@logout')->middleware('auth:sanctum');
Route::post('techniciens/reset_password', 'App\Http\Controllers\API\TechnicienController@resetPassword');




//Routes pour l'authentifiaction des user et super admin
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth:sanctum');



Route::middleware('auth:sanctum')->group(function () {
    // Routes pour l'admin
    Route::middleware('role:admin')->group(function () {
        // Routes pour les methode CRUD DES CLIENTS
        Route::apiResource('clients', ClientController::class);
        // Routes pour les methodes CRUD DES SITES
        Route::apiResource('sites', SiteController::class);
        // Routes pour les methodes CRUD DES contrats
        Route::apiResource('contrats', ContratController::class);
        // Routes pour les methodes CRUD DES contrats
        Route::apiResource('extincteurs', ExtincteurController::class);
        // Routes pour les methodes CRUD DES interventions
        Route::apiResource('interventions', InterventionController::class);
        // Routes pour les methodes CRUD DES souscriptions
        Route::apiResource('souscriptions', SouscriptionController::class);
        // Routes pour les methodes CRUD DES techniciens
        Route::apiResource('techniciens', TechnicienController::class);
        // Routes pour les methodes CRUD DES techniciens
        Route::apiResource('categories', CategorieController::class);
    });


    // Routes pour le super admin
    Route::middleware('role:superadmin')->group(function () {

        //Create delete update admins
        Route::get('/admin', [AdminController::class, 'index']);
        Route::post('/admin', [AdminController::class, 'create']);
        Route::put('/admin/{id}', [AdminController::class, 'update']);
        Route::delete('/admin/{id}', [AdminController::class, 'delete']);
        //Create delete update super-admins
        Route::get('/superadmin', [SuperAdminController::class, 'index']);
        Route::post('/superadmin', [SuperAdminController::class, 'create']);
        Route::put('/superadmin/{id}', [SuperAdminController::class, 'update']);
        Route::delete('/superadmin/{id}', [SuperAdminController::class, 'delete']);

        // Routes pour les methode CRUD DES CLIENTS
        Route::apiResource('clients', ClientController::class);
        // Routes pour les methodes CRUD DES SITES
        Route::apiResource('sites', SiteController::class);
        // Routes pour les methodes CRUD DES contrats
        Route::apiResource('contrats', ContratController::class);
        // Routes pour les methodes CRUD DES contrats
        Route::apiResource('extincteurs', ExtincteurController::class);
        // Routes pour les methodes CRUD DES interventions
        Route::apiResource('interventions', InterventionController::class);
        // Routes pour les methodes CRUD DES souscriptions
        Route::apiResource('souscriptions', SouscriptionController::class);
        // Routes pour les methodes CRUD DES techniciens
        Route::apiResource('techniciens', TechnicienController::class);
        // Routes pour les methodes CRUD DES techniciens
        Route::apiResource('categories', CategorieController::class);
    });
});

///Search APIs

Route::get("clients/search/{nom_client}", [ClientController::class, 'search']);
Route::get("users/search/{name}", [UserController::class, 'search']);
Route::get("techniciens/search/{nom_technicien}", [TechnicienController::class, 'search']);
Route::get("sites/search/{nom_site}", [SiteController::class, 'search']);
Route::get("users/search/{role}", [RoleController::class, 'search']);
