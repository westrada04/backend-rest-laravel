<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuidadorNinoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuidador_nino', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nino_id')->unsigned();
            $table->integer('cuidador_id')->unsigned();

            $table->timestamps();


            $table->foreign('nino_id')->references('id')->on('ninos')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('cuidador_id')->references('id')->on('cuidadores')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cuidador_nino');
    }
}
