<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSubCommitteeMembersTable extends Migration
{
    public function up()
    {
        Schema::table('sub_committee_members', function (Blueprint $table) {
            $table->unsignedBigInteger('comittee_name_id')->nullable();
            $table->foreign('comittee_name_id', 'comittee_name_fk_6050930')->references('id')->on('committee_names');
            $table->unsignedBigInteger('member_id')->nullable();
            $table->foreign('member_id', 'member_fk_6050931')->references('id')->on('users');
        });
    }
}
