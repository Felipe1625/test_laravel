<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class beneficios extends Model
{
    public function ficha()
    {
        return $this->belongsTo(ficha::class,'id_ficha');
    }

    public function montoMaximo()
    {
        return $this->hasOne(montos_maximos::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function beneficio_entregado()
    {
        return $this->hasOne(beneficios_entregados::class, 'id_beneficio');
    }

}
