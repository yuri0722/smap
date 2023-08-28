<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pessoa_id')->unsigned()->nullable();
            $table->foreign('pessoa_id')->references('id')->on('pessoas');
            $table->integer('porte_id')->unsigned();
            $table->foreign('porte_id')->references('id')->on('porte_animals');
            $table->integer('especie_id')->unsigned();
            $table->foreign('especie_id')->references('id')->on('especie_animals');
            $table->string('nome', 150);
            $table->char('situacao', 1)->default('P');
            $table->string('raca', 100)->nullable();
            $table->string('chip', 50)->nullable();
            $table->string('caracteristicas')->nullable();
            $table->string('pelagem', 100)->nullable();
            $table->integer('anos')->nullable();
            $table->integer('meses')->nullable();
            $table->integer('kilos')->nullable();
            $table->integer('gramas')->nullable();
            $table->char('sexo', 1)->default('M');
            $table->char('castrado', 1)->default('N');
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
        Schema::dropIfExists('animals');
    }
}
