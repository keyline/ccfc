<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReciprocalClubsTable extends Migration
{
    public function up()
    {
        Schema::create('reciprocal_clubs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('reciprocal_club_name');
            $table->string('image')->nullable();
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->longText('details')->nullable();
            $table->string('cub_type');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
