<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Technicien extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    public function extincteurs()
    {
        return $this->belongsToMany(Extincteur::class);
    }

    //relation d'heritage avec la classe users
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'photo_technicien',
        'nom_technicien',
        'prenom_technicien',
        'email_technicien',
        'password_technicien',
        'adresse_technicien',
        'telephone_technicien'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password_technicien',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
