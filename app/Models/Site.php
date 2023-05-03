<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    // fonction de relation avec la table Client

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function extincteur()
    {
        return $this->hasMany(Extincteur::class);
    }
}
