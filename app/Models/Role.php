<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Role extends Model
{
    use HasFactory;

    // Relation many-to-one avec le modèle User

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
