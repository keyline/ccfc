<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToContentBlocksTable extends Migration
{
    public function up()
    {
        Schema::table('content_blocks', function (Blueprint $table) {
            $table->unsignedBigInteger('source_page_id')->nullable();
            $table->foreign('source_page_id', 'source_page_fk_6023733')->references('id')->on('content_pages');
        });
    }
}
