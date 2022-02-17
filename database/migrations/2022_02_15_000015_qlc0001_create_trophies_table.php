<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Qlc0001CreateTrophiesTable extends Migration
{
    public function up()
    {
        Schema::create('trophies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('trophy');
            $table->longText('trophy_description')->nullable();
            $table->string('year_of_award')->nullable();
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
        Schema::dropIfExists('trophies');
    }
}
