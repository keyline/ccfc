<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('member_type_code')->nullable();
            $table->string('member_type')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('member_since')->nullable();
            $table->string('sex')->nullable();
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->string('address_3')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('pin')->nullable();
            $table->string('phone_1')->nullable();
            $table->string('phone_2')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('email')->nullable();
            $table->string('current_status')->nullable();
            $table->string('represented_club_in')->nullable();
            $table->string('hobbies_interest')->nullable();
            $table->string('business_profession')->nullable();
            $table->string('category')->nullable();
            $table->string('business_address_1')->nullable();
            $table->string('business_address_2')->nullable();
            $table->string('business_address_3')->nullable();
            $table->string('business_city')->nullable();
            $table->string('business_state')->nullable();
            $table->string('business_pin')->nullable();
            $table->string('business_phone_1')->nullable();
            $table->string('business_phone_2')->nullable();
            $table->string('business_email')->nullable();
            $table->string('spouse_name')->nullable();
            $table->date('spouse_dob')->nullable();
            $table->string('spouse_sex')->nullable();
            $table->string('spouse_phone_1')->nullable();
            $table->string('spouse_phone_2')->nullable();
            $table->string('spouse_mobile_no')->nullable();
            $table->string('spouse_email')->nullable();
            $table->date('anniversary_date')->nullable();
            $table->string('spouse_business_profession')->nullable();
            $table->string('spouse_business_category')->nullable();
            $table->string('spouse_business_address_1')->nullable();
            $table->string('spouse_business_address_2')->nullable();
            $table->string('spouse_business_address_3')->nullable();
            $table->string('spouse_business_city')->nullable();
            $table->string('spouse_business_state')->nullable();
            $table->string('spouse_business_pin')->nullable();
            $table->string('spouse_business_phone_1')->nullable();
            $table->string('spouse_business_phone_2')->nullable();
            $table->string('spouse_business_email')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
