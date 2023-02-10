<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->string('employee_code', 255);
            $table->date('date_of_birth');
            $table->string('home_town', 255)->nullable();
            $table->string('current_residence', 255)->nullable();
            $table->string('university', 255)->nullable();
            $table->string('working_form', 255)->nullable();
            $table->date('time_start');
            $table->string('member_company', 255);
            $table->unsignedBigInteger('position_id')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('role_id')->nullable();
            $table->string('japanese', 255)->nullable();
            $table->string('avatar', 255)->nullable();
            $table->integer('gender')->default(0);
            $table->string('national', 255)->nullable();
            $table->string('ethnic', 255)->nullable();
            $table->string('phone', 255);
            $table->string('relative_phone',255)->nullable();
            $table->string('passport', 255);
            $table->date('date_range')->nullable();
            $table->string('place_issue', 255)->nullable();
            $table->string('visa', 255)->nullable();
            $table->date('duration_visa')->nullable();
            $table->string('link_fb', 255)->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('user_details', function($table) {
            $table->foreign('position_id')->references('id')->on('positions');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_details');
    }
}
