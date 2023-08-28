<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVeiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('veiculos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome', 150);
            $table->integer('veiculo_tipo_id')->unsigned();
            $table->foreign('veiculo_tipo_id')->references('id')->on('veiculo_tipos');
            $table->integer('quilometragem');
            $table->string('placa',20)->nullable();
            $table->string('marca',100)->nullable();
            $table->string('modelo',100)->nullable();
            $table->string('cor',100)->nullable();
            $table->string('ano',20)->nullable();
            $table->text('observacao')->nullable();
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
        Schema::dropIfExists('veiculos');
    }
}
