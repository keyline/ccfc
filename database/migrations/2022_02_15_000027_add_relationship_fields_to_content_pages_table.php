<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToContentPagesTable extends Migration
{
    public function up()
    {
        Schema::table('content_pages', function (Blueprint $table) {
            $table->unsignedBigInteger('gallery_id')->nullable();
            $table->foreign('gallery_id', 'gallery_fk_5952075')->references('id')->on('galleries');
        });
    }
}
