<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Qlc0001CreateCommitteeNamesTable extends Migration
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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('committee_names');
    }
}
