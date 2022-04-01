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
            $table->string('member_type_code',10)->nullable();
            $table->string('member_type',50)->nullable();
            $table->date('date_of_birth',50)->nullable();
            $table->string('member_since',50)->nullable();
            $table->string('sex',50)->nullable();
            $table->string('address_1',150)->nullable();
            $table->string('address_2',150)->nullable();
            $table->string('address_3',150)->nullable();
            $table->string('city',50)->nullable();
            $table->string('state',50)->nullable();
            $table->string('pin',50)->nullable();
            $table->string('phone_1',50)->nullable();
            $table->string('phone_2',50)->nullable();
            $table->string('mobile_no',50)->nullable();
            $table->string('email',100)->nullable();
            $table->string('current_status')->nullable();
            $table->string('represented_club_in')->nullable();
            $table->string('hobbies_interest',150)->nullable();
            $table->string('business_profession',150)->nullable();
            $table->string('category')->nullable();
            $table->string('business_address_1',150)->nullable();
            $table->string('business_address_2',150)->nullable();
            $table->string('business_address_3',150)->nullable();
            $table->string('business_city',50)->nullable();
            $table->string('business_state',100)->nullable();
            $table->string('business_pin',100)->nullable();
            $table->string('business_phone_1',100)->nullable();
            $table->string('business_phone_2',100)->nullable();
            $table->string('business_email',100)->nullable();
            $table->string('spouse_name',50)->nullable();
            $table->date('spouse_dob',50)->nullable();
            $table->string('spouse_sex',50)->nullable();
            $table->string('spouse_phone_1',50)->nullable();
            $table->string('spouse_phone_2',50)->nullable();
            $table->string('spouse_mobile_no',50)->nullable();
            $table->string('spouse_email',50)->nullable();
            // $table->date('anniversary_date',50)->nullable();
            $table->string('spouse_business_profession',150)->nullable();
            $table->string('spouse_business_category',150)->nullable();
            $table->string('spouse_business_address_1',150)->nullable();
            $table->string('spouse_business_address_2',150)->nullable();
            $table->string('spouse_business_address_3',150)->nullable();
            $table->string('spouse_business_city',100)->nullable();
            $table->string('spouse_business_state',100)->nullable();
            $table->string('spouse_business_pin',50)->nullable();
            $table->string('spouse_business_phone_1',50)->nullable();
            $table->string('spouse_business_phone_2',50)->nullable();
            $table->string('spouse_business_email',100)->nullable();

            $table->mediumText('member_image')->nullable();
            $table->mediumText('spouse_image')->nullable();

            $table->string('children1_name',50)->nullable();
            $table->string('children1_dob',50)->nullable();
            $table->string('children1_sex',50)->nullable();
            $table->string('children1_phone1',50)->nullable();
            $table->string('children1_phone2',50)->nullable();
            $table->string('children1_mobileno',50)->nullable();

            // $table->binary('children1_image')->nullable();   

            $table->string('children2_name',50)->nullable();
            $table->string('children2_dob',50)->nullable();
            $table->string('children2_sex',50)->nullable();
            $table->string('children2_phone1',50)->nullable();
            $table->string('children2_phone2',50)->nullable();
            $table->string('children2_mobileno',50)->nullable();

            // $table->binary('children2_image')->nullable();

            $table->string('children3_name',50)->nullable();
            $table->string('children3_dob',50)->nullable();
            $table->string('children3_sex',50)->nullable();
            $table->string('children3_phone1',50)->nullable();
            $table->string('children3_phone2',50)->nullable();
            $table->string('children3_mobileno',50)->nullable();

            // $table->binary('children3_image')->nullable();

            // $table->string('children4_name',50)->nullable();
            // $table->string('children4_dob',50)->nullable();
            // $table->string('children4_sex',50)->nullable();
            // $table->string('children4_phone1',50)->nullable();
            // $table->string('children4_phone2',50)->nullable();
            // $table->string('children4_mobileno',50)->nullable();

            // $table->binary('children4_image')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
        });
    }
}