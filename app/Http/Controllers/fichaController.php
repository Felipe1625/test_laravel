<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ficha;

class fichaController extends Controller
{
    public function guardarFicha(Request $request){
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'url' => 'required',
            'publicada' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $newFicha = new ficha;
        $newFicha->nombre = $request->nombre;
        $newFicha->url = $request->url;
        $newFicha->publicada = $request->publicada;
        $newFicha->save();
        return response()->json(['message' => 'Ficha guardada con exito'], 200);
    }
}
