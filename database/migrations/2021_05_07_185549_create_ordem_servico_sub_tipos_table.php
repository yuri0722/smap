<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdemServicoSubTiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordem_servico_sub_tipos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('ordem_servico_tipo_id')->unsigned();
            $table->foreign('ordem_servico_tipo_id')->references('id')->on('ordem_servico_tipos');
            $table->string('nome',100);
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
        Schema::dropIfExists('ordem_servico_sub_tipos');
    }
}
