<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommitteeNamesTable extends Migration
{
    public function up()
    {
        Schema::create('committee_names', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('committee_name_master');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}