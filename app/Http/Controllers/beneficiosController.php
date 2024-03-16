<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\beneficios;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class beneficiosController extends Controller
{
    public function guardarBeneficios(Request $request){
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'id_usuario' => 'required',
            'id_ficha' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $newBeneficio = new beneficios;
        $newBeneficio->nombre = $request->nombre;
        $newBeneficio->id_ficha = $request->id_ficha;
        $newBeneficio->id_usuario = $request->id_usuario;
        $newBeneficio->fecha = Carbon::now();
        $newBeneficio->save();
        return response()->json(['message' => 'Beneficio guardado con exito'], 200);
    }
}
