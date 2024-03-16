<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMontosMaximosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('montos_maximos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_beneficio');
            $table->decimal('monto_minimo', 10, 2);
            $table->decimal('monto_maximo', 10, 2);
            $table->timestamps();

            $table->foreign('id_beneficio')->references('id')->on('beneficios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('montos_maximos');
    }
}
