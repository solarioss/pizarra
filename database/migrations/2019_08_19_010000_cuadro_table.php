<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CuadroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuadro', function (Blueprint $table) {
            $table->id();
            $table->string('sesion', 80);
            $table->Integer('x');
            $table->Integer('y');
            $table->string('nombre', 80)->nullable();
            $table->Integer('tipo');
            $table->string('padre', 80)->nullable();
            $table->string('hijo1', 80)->nullable();
            $table->string('hijo2', 80)->nullable();
            $table->string('hijo3', 80)->nullable();
            $table->string('codificacion', 80)->nullable();
            $table->string('instruccion', 80)->nullable();

           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cuadro');
    }
}