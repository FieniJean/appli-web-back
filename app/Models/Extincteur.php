<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extincteur extends Model
{
    use HasFactory;
    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function categorie()
    {
        return $this->belongTo(categorie::class);
    }

    public function techniciens()
    {
        return $this->belongsToMany(Technicien::class);
    }
}
