<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSportstypesTable extends Migration
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
}
