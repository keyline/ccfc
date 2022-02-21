<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentBlocksTable extends Migration
{
    public function up()
    {
        Schema::create('content_blocks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_of_the_block')->nullable();
            $table->string('heading')->nullable();
            $table->longText('body')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
