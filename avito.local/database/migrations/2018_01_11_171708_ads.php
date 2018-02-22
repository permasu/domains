<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Ads extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
        $table->increments('id');
        $table->string('avito_id');
        $table->string('href');
        $table->string('title');
        $table->integer('etazh');
        $table->integer('maxetazh');
        $table->double('price');
        $table->string('district');
        $table->string('address');
        $table->timestamps();

        });
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
