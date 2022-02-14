<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewssTable extends Migration
{
    public function up()
    {
        Schema::create('newss', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('news_title');
            $table->longText('news_details')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
