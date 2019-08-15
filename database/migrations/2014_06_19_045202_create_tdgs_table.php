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
            $table->string('ciclo',7)->nonullable();
            $table->integer('escuela_id')->unsigned()->nonullable();
            $table->foreign('escuela_id')->references('id')->on('colleges')->onDelete('cascade')->nonullable();
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
