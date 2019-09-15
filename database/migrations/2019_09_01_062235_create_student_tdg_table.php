<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentTdgTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_tdg', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned()->nonullable();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade')->nonullable();
            $table->integer('tdg_id')->unsigned()->nonullable();
            $table->foreign('tdg_id')->references('id')->on('tdgs')->onDelete('cascade')->nonullable();
            $table->integer('ciclo_id')->unsigned()->nonullable();
            $table->foreign('ciclo_id')->references('id')->on('semesters')->onDelete('cascade')->nonullable();
            $table->double('nota',3,2)->nullable();
            $table->boolean('activo')->nullable();
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
        Schema::dropIfExists('student_tdg');
    }
}
