<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCommitteeMemberMappingsTable extends Migration
{
    public function up()
    {
        Schema::table('committee_member_mappings', function (Blueprint $table) {
            $table->unsignedBigInteger('committee_id')->nullable();
            $table->foreign('committee_id', 'committee_fk_5919864')->references('id')->on('committee_names');
            $table->unsignedBigInteger('member_id')->nullable();
            $table->foreign('member_id', 'member_fk_5919865')->references('id')->on('users');
        });
    }
}
