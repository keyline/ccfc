<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Qlc0001CreateSportstypesTable extends Migration
{
    public function up()
    {
        Schema::create('sportstypes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sport_name');
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
        Schema::dropIfExists('sportstypes');
    }
}
