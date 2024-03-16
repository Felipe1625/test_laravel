<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class beneficios_entregados extends Model
{   
    public function beneficio()
    {
        return $this->belongsTo(beneficios::class,'id_beneficio');
    }
}
