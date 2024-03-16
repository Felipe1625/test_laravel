<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Models\beneficios_entregados;

class beneficiosEntregadosController extends Controller
{   
    public function guardarBeneficiosEntregados(Request $request){
        $validator = Validator::make($request->all(), [
            'id_beneficio' => 'required',
            'run' => 'required',
            'dv' => 'required',
            'total' => 'required',
            'estado' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $newBeneficiosEntregados = new beneficios_entregados;
        $newBeneficiosEntregados->id_beneficio = $request->id_beneficio;
        $newBeneficiosEntregados->run = $request->run;
        $newBeneficiosEntregados->dv = $request->dv;
        $newBeneficiosEntregados->total = $request->total;
        $newBeneficiosEntregados->estado = $request->estado;
        $newBeneficiosEntregados->fecha=Carbon::now();
        $newBeneficiosEntregados->save();
        return response()->json(['message' => 'Beneficios entregados guardado con exito'], 200);
    }

    public function misbeneficios($run){
        Carbon::setLocale('es');
        $data = [];
        $usuario = User::where('run', $run)->first();
        

        if (!$usuario) {
            return response()->json([
                'code' => 404,
                'success' => false,
                'message' => 'Usuario de run ' .$run . ' no encontrado.'
            ], 404);
        }

        $beneficiosPorAnio = $usuario->beneficios()
        ->selectRaw('YEAR(beneficios_entregados.fecha) as year, COUNT(*) as num, SUM(beneficios_entregados.total) as montoTotal')
        ->join('beneficios_entregados', 'beneficios.id', '=', 'beneficios_entregados.id_beneficio')
        ->groupBy('year')
        ->get();

        foreach ($beneficiosPorAnio as $beneficio) {
            $beneficios = $usuario->beneficios()->with('ficha','beneficio_entregado')
                ->whereYear('fecha', $beneficio->year)
                ->get()
                ->map(function ($item) {
                    $mes = Carbon::createFromFormat('Y-m-d', $item->fecha)->monthName;
                    $ficha = $item->ficha->publicada ? $item->ficha : null;
                    $beneficio_entregado = $item->beneficio_entregado;

                    if(!is_null($beneficio_entregado)){
                        return [
                            'id' => $item->id,
                            'nombre' => $item->nombre,
                            'total' => $beneficio_entregado->total,
                            'fecha' => $item->fecha,
                            'mes' => $mes,
                            'ficha' => $ficha
                        ];
                    }
                })->filter();

            $data[] = [
                'year' => $beneficio->year,
                'num' => $beneficio->num,
                'montoTotal' => '$' . number_format($beneficio->montoTotal, 0, ',', '.'),
                'beneficios' => $beneficios
            ];
        }

        return response()->json([
            'code' => 200,
            'success' => true,
            'data' => [
                'beneficios' => $data
            ]
        ]);
    }
}
