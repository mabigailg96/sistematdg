<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfessorRequestTribunalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professor_request_tribunal', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('professor_id')->unsigned()->nonullable();
            $table->foreign('professor_id')->references('id')->on('professors')->onDelete('cascade')->nonullable();
            $table->integer('request_tribunal_id')->unsigned()->nonullable();
            $table->foreign('request_tribunal_id')->references('id')->on('request_tribunals')->onDelete('cascade')->nonullable();
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
        Schema::dropIfExists('professor_request_tribunal');
    }
}
