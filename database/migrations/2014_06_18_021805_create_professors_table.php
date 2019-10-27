<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfessorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo', 10)->unique()->nonullable();
            $table->string('nombre',100)->nonullable();
            $table->string('apellido',100)->nonullable();
            $table->integer('escuela_id')->unsigned()->nonullable();
            $table->foreign('escuela_id')->references('id')->on('colleges')->onDelete('cascade')->nonullable();
            $table->string('estado', 10)->default('Activo');
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
        Schema::dropIfExists('professors');
    }
}
