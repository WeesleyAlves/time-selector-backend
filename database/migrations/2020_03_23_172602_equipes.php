<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Equipes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipes', function (Blueprint $table) {
            $table->string('id_equipe',32);
            $table->string('nome',100);
            $table->string('local',100);
            $table->string('horaEntrada',5);
            $table->string('horaSaida',5);
            $table->string('goleiro',100)->nullable($value = true);
            $table->string('linha1',100)->nullable($value = true);
            $table->string('linha2',100)->nullable($value = true);
            $table->string('linha3',100)->nullable($value = true);
            $table->string('linha4',100)->nullable($value = true);
            $table->unique('id_equipe');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipes');
    }
}
