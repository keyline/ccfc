<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Qlc0001CreatePastPresidentsTable extends Migration
{
    public function up()
    {
        Schema::create('past_presidents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('duration')->nullable();
            $table->integer('short_order')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('past_presidents');
    }
}
