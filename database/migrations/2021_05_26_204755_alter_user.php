<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_motorista')->default(0);
            $table->boolean('md_animal')->default(0);
            $table->boolean('md_agro')->default(0);
            $table->boolean('md_pesca')->default(0);
            $table->boolean('md_sim')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_motorista');
            $table->dropColumn('md_animal');
            $table->dropColumn('md_agro');
            $table->dropColumn('md_pesca');
            $table->dropColumn('md_sim');
        });
    }
}
