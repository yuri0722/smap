<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePessoasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pessoas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 150);
            $table->string('email', 100)->nullable();
            $table->string('nome_fantasia', 150)->nullable();
            $table->char('pessoa_tipo', 1)->default('F');
            $table->string('cpf', 11)->nullable();
            $table->string('cnpj', 20)->nullable();
            $table->date('data_nascimento')->nullable();
            $table->char('sexo', 1)->nullable();
            $table->string('rg', 15)->nullable();
            $table->string('nacionalidade', 30)->nullable();
            $table->string('telefone', 20)->nullable();
            $table->string('celular', 20)->nullable();
            $table->integer('cidade_id')->unsigned()->nullable();
            $table->foreign('cidade_id')->references('id')->on('cidades');
            $table->string('endereco', 150)->nullable();
            $table->string('bairro', 100)->nullable();
            $table->string('complemento', 150)->nullable();
            $table->string('cep', 9)->nullable();
            $table->string('numero', 10)->nullable();
            $table->char('status', 1)->nullable();
            $table->boolean('is_agricultor')->default(0);
            $table->boolean('is_pescador')->default(0);
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
        Schema::dropIfExists('pessoas');
    }
}
