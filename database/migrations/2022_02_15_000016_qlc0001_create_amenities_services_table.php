<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Qlc0001CreateAmenitiesServicesTable extends Migration
{
    public function up()
    {
        Schema::create('amenities_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('amenity_name');
            $table->longText('amenity_details')->nullable();
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
        Schema::dropIfExists('amenities_services');
    }
}
