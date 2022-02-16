<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Qlc0001CreateSportsmenTable extends Migration
{
    public function up()
    {
        Schema::create('sportsmen', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('details')->nullable();
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
        Schema::dropIfExists('sportsmen');
    }
}
