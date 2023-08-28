<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCastracaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('castracaos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('animal_id')->unsigned()->nullable();
            $table->foreign('animal_id')->references('id')->on('animals');
            $table->char('anestesia', 1)->default('N');
            $table->string('anestesia_descricao')->nullable();
            $table->char('doente_recente', 1)->default('N');
            $table->string('doente_recente_descricao')->nullable();
            $table->char('convulsao', 1)->default('N');
            $table->char('diarreia_vomito', 1)->default('N');
            $table->char('sensibilidade_medicamento', 1)->default('N');
            $table->string('sensibilidade_medicamento_descricao')->nullable();
            $table->char('alimentacao_normal', 1)->default('S');
            $table->char('vermifugado', 1)->default('N');
            $table->char('vacinado', 1)->default('N');
            $table->char('comportamento_anormal', 1)->default('N');
            $table->string('comportamento_anormal_descricao')->nullable();
            $table->char('falhas_nos_pelos', 1)->default('N');
            $table->char('secrecao_vaginal', 1)->default('N');
            $table->char('secrecao_olhos', 1)->default('N');
            $table->char('coceira', 1)->default('N');
            $table->integer('ecc')->nullable();
            $table->integer('tpc')->nullable();
            $table->decimal('temperatura', 15, 3)->nullable();
            $table->integer('bpm')->nullable();
            $table->char('pulso', 5)->default('FORTE');
            $table->integer('fr')->nullable();
            $table->string('mucosas')->nullable();
            $table->string('hidratacao')->nullable();
            $table->text('observacao')->nullable();
            $table->char('castrado', 1)->default('S');
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
        Schema::dropIfExists('castracaos');
    }
}
