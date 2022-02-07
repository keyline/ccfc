<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEventDetailsTable extends Migration
{
    public function up()
    {
        Schema::table('event_details', function (Blueprint $table) {
            $table->unsignedBigInteger('gallery_id')->nullable();
            $table->foreign('gallery_id', 'gallery_fk_5922693')->references('id')->on('galleries');
        });
    }
}
