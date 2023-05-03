<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class Client extends Authenticatable
{
    use HasFactory, notifiable, HasApiTokens;

    public function sites()
    {
        return $this->hasMany(Site::class);
    }

    public function contrats()
    {
        return $this->belongsToMany(Contrat::class);
    }

    //relation d'heritage with  users class
    public function users()
    {
        return $this->belongsTo(User::class);
    }

    // Propriétés spécifiques à Client
    protected $fillable = [
        'nom_client',
        'statut_client',
        'prenom_client',
        'email_client',
        'password_client',
        'adresse_client',
        'telephone_client',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password_client',
    ];

    //Ajout des validations supplémentaires
    public static $rules = [
        'nom_client' => 'required|string|min:3',
        'statut_client' => 'required|in:particulier,entreprise',
        'email_client' => 'required|email|unique:clients',
        'password_client' => 'required|string|min:8|confirmed',
        'adresse_client' => 'required|string',
        'telephone_client' => 'required|string|regex:/^\+[1-9]\d{1,14}$/'
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // ...


}
