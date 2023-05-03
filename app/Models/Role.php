<?php

namespace App\Models;

use Spatie\Permission\Traits\HasPermissions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Spatie\Permission\Models\Role as SpatieRole;// Role avec spacie


class Role extends Model
{
    use HasFactory, HasPermissions;

    // Relation many-to-one avec le modèle User

    public function users()
    {
        return $this->hasMany(User::class);
    }
}

// class Role extends SpatieRole
// {
//     // ...
// }
