<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\beneficiosEntregadosController;
use App\Http\Controllers\beneficiosController;
use App\Http\Controllers\fichaController;
use App\Http\Controllers\montosMaximosController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/misbeneficios/{rut}', [beneficiosEntregadosController::class,'misbeneficios'])->name('misbeneficios');
Route::post('/guardarBeneficios', [beneficiosController::class,'guardarBeneficios'])->name('guardarBeneficios');
Route::post('/guardarFicha', [fichaController::class,'guardarFicha'])->name('guardarFicha');
Route::post('/guardarMontoMaximo', [montosMaximosController::class,'guardarMontoMaximo'])->name('guardarMontoMaximo');
Route::post('/guardarBeneficiosEntregados', [beneficiosEntregadosController::class,'guardarBeneficiosEntregados'])->name('guardarBeneficiosEntregados');

Route::get('/mostrar', function () {
    $token = csrf_token();
    return response()->json(['csrf_token' => $token]);
});