<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ficha extends Model
{
    public function beneficios()
    {
        return $this->hasMany(beneficios::class);
    }
}
