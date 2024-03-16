<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\montos_maximos;

class montosMaximosController extends Controller
{
    public function guardarMontoMaximo(Request $request){
        $validator = Validator::make($request->all(), [
            'id_beneficio' => 'required',
            'monto_minimo' => 'required',
            'monto_maximo' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $newMontoMaximo = new montos_maximos;
        $newMontoMaximo->id_beneficio = $request->id_beneficio;
        $newMontoMaximo->monto_minimo = $request->monto_minimo;
        $newMontoMaximo->monto_maximo = $request->monto_maximo;
        $newMontoMaximo->save();
        return response()->json(['message' => 'Monto Maximo guardado con exito'], 200);
    }
}
