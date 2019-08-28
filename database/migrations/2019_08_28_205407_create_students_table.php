<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('carnet',8)->unique()->nonullable();
            $table->string('nombres',100)->nonullable();
            $table->string('apellidos',100)->nonullable();
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
        Schema::dropIfExists('students');
    }
}
