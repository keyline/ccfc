<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMembersTable extends Migration
{
    public function up()
    {
        Schema::table('members', function (Blueprint $table) {
            $table->unsignedBigInteger('select_member_id')->nullable();
            $table->foreign('select_member_id', 'select_member_fk_5922687')->references('id')->on('users');
            $table->unsignedBigInteger('select_title_id')->nullable();
            $table->foreign('select_title_id', 'select_title_fk_5922688')->references('id')->on('titles');
        });
    }
}
