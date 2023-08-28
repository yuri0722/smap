<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdemServicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordem_servicos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('agricultor_id')->unsigned()->nullable();
            $table->foreign('agricultor_id')->references('id')->on('agricultors');
            $table->integer('ordem_servico_tipo_id')->unsigned();
            $table->foreign('ordem_servico_tipo_id')->references('id')->on('ordem_servico_tipos');
            $table->integer('ordem_servico_sub_tipo_id')->unsigned();
            $table->foreign('ordem_servico_sub_tipo_id')->references('id')->on('ordem_servico_sub_tipos');
            $table->integer('veiculo_id')->unsigned()->nullable();
            $table->foreign('veiculo_id')->references('id')->on('veiculos');
            $table->integer('motorista_id')->unsigned()->nullable();
            $table->foreign('motorista_id')->references('id')->on('users');
            $table->decimal('area', 15, 3)->nullable();
            $table->integer('horas_solicitadas');
            $table->integer('horas_empenhadas')->nullable();
            $table->date('data_agendamento')->nullable();
            $table->date('data_servico')->nullable();
            $table->text('observacao')->nullable();
            $table->string('ponto_referencia', 250)->nullable();
            $table->char('status', 1)->default('A')->comment('A- Aberto, E- Esperando, F - Finalizada');
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
        Schema::dropIfExists('ordem_servicos');
    }
}
