<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestExtensionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_extensions', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha')->nonullable();
            $table->boolean('aprobado')->nonullable();
            $table->date('fecha_inicio')->nonullable();
            $table->date('fecha_fin')->nonullable();
            $table->string('justificacion',500)->nonullable();
            $table->integer('tdg_id')->unsigned()->nonullable();
            $table->foreign('tdg_id')->references('id')->on('tdgs')->onDelete('cascade')->nonullable();
            $table->integer('agreement_id')->unsigned()->nullable();
            $table->foreign('agreement_id')->references('id')->on('agreements')->onDelete('cascade')->nullable();
            $table->integer('type_extension_id')->unsigned()->nonullable();
            $table->foreign('type_extension_id')->references('id')->on('type_extensions')->onDelete('cascade')->nonullable();
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
        Schema::dropIfExists('request_extensions');
    }
}
