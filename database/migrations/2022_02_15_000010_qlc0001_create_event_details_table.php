<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Qlc0001CreateEventDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('event_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('event_title');
            $table->longText('event_details')->nullable();
            $table->date('event_date');
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
        Schema::dropIfExists('event_details');
    }
}
