<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgricultorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agricultors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('pessoa_id')->unsigned();
            $table->foreign('pessoa_id')->references('id')->on('pessoas');
            $table->string('numero_sindicato')->nullable();
            $table->string('numero_epagri')->nullable();
            $table->string('numero_cidasc')->nullable();
            $table->string('numero_bloco_notas')->nullable();
            $table->char('beneficio_governo', 1)->default('N');
            $table->integer('numero_animais')->nullable();
            $table->decimal('renda_anual', 15, 3)->nullable();
            $table->integer('nr_agro_familia')->default(1)->comment('nr de pessoas da família que trabalha na atividade agropecuária');
            $table->char('engenho_farinha', 1)->default('N');
            $table->char('engenho_cana', 1)->default('N');
            $table->text('producao')->nullable();
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
        Schema::dropIfExists('agricultors');
    }
}
