<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestNamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_names', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha')->nonullable();
            $table->boolean('aprobado')->nonullable();
            $table->string('nuevo_nombre')->nonullable();
            $table->string('justificacion')->nonullable();
            $table->integer('tdg_id')->unsigned()->nonullable();
            $table->foreign('tdg_id')->references('id')->on('tdgs')->onDelete('cascade')->nonullable();
            $table->integer('agreement_id')->unsigned()->nonullable();
            $table->foreign('agreement_id')->references('id')->on('agreements')->onDelete('cascade')->nonullable();
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
        Schema::dropIfExists('request_names');
    }
}
