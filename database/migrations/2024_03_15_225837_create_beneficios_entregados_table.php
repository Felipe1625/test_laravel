<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeneficiosEntregadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beneficios_entregados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_beneficio');
            // $table->unsignedBigInteger('id_usuario');
            $table->string('run');
            $table->string('dv', 1);
            $table->decimal('total', 10, 2);
            $table->string('estado');
            $table->date('fecha');
            $table->timestamps();

            $table->foreign('id_beneficio')->references('id')->on('beneficios');
            // $table->foreign('id_usuario')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('beneficios_entregados');
    }
}
