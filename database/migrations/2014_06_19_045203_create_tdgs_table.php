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
            $table->enum('estado_oficial',['aprobado','oficializado','abanadonado','prorrogado','tribunal','resultado']);
            $table->enum('estado_escuela',['ingresado','asignado','prorrogado','tribunal','resultado']);
            $table->integer('profesor_id')->unsigned()->nonullable();
            $table->foreign('profesor_id')->references('id')->on('professors')->onDelete('cascade')->nonullable();
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
