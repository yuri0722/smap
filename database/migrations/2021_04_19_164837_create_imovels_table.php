<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImovelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imovels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('pessoa_id')->unsigned()->nullable();
            $table->foreign('pessoa_id')->references('id')->on('pessoas');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('bairro_id')->unsigned()->nullable();
            $table->foreign('bairro_id')->references('id')->on('bairros');
            $table->string('matricula',20)->nullable();
            $table->string('inscricao_incra',20)->nullable();
            $table->decimal('area', 15, 3)->nullable();
            $table->decimal('area_construida', 15, 3)->nullable();
            $table->char('rural', 1)->default('S');
            $table->char('desconto_agricola', 1)->default('S');
            $table->char('tem_car', 1)->default('N');
            $table->string('lat',20)->nullable();
            $table->string('lon',20)->nullable();
            $table->string('endereco', 150)->nullable();
            $table->string('complemento', 250)->nullable();
            $table->integer('imovel_id_sistema')->nullable();
            $table->char('ativo', 1)->default("S");
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
        Schema::dropIfExists('imovels');
    }
}
