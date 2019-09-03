<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTdgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tdgs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',500)->nonullable();
            $table->string('codigo',10)->unique()->nonullable();
            $table->string('perfil')->unique()->nonullable();
            $table->enum('estado_oficial',['Aprobado','Oficializado','Abandonado','Prórroga','Extensión de prórroga','Prórroga especial','Tribunal','Resultados','Finalizado']);
            $table->enum('estado_escuela',['Recien ingresado','Asignación','Abandonado','Prórroga','Extensión de prórroga','Prórroga especial','Tribunal','Resultados','Finalizado']);
            $table->integer('profesor_id')->unsigned()->nullable();
            $table->foreign('profesor_id')->references('id')->on('professors')->onDelete('cascade')->nullable();
            $table->integer('escuela_id')->unsigned()->nonullable();
            $table->foreign('escuela_id')->references('id')->on('colleges')->onDelete('cascade')->nonullable();
            $table->integer('ciclo_id')->unsigned()->nonullable();
            $table->foreign('ciclo_id')->references('id')->on('semesters')->onDelete('cascade')->nonullable();
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
        Schema::dropIfExists('tdgs');
    }
}
