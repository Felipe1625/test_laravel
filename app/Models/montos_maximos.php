<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class montos_maximos extends Model
{
    public function beneficio()
    {
        return $this->belongsTo(beneficios::class);
    }
}
