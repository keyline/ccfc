<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Qlc0001AddRelationshipFieldsToAmenitiesServicesTable extends Migration
{
    public function up()
    {
        Schema::table('amenities_services', function (Blueprint $table) {
            $table->unsignedBigInteger('image_gallery_id')->nullable();
            $table->foreign('image_gallery_id', 'image_gallery_fk_5922673')->references('id')->on('galleries');
        });
    }
}
