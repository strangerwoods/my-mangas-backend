<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Manga;

class Genre extends Model
{
    public function manga() {
        return $this->belongsToMany(Manga::class);
    }
}
