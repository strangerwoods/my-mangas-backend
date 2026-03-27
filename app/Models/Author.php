<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Manga;

class Author extends Model
{
    public function manga() {
        return $this->hasMany(Manga::class);
    }
}
