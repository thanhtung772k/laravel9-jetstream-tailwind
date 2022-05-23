<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddTimesheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_timesheets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('timesheet_id');
            $table->foreignId('user_id');
            $table->time('check_in_real')->nullable();
            $table->time('check_out_real')->nullable();
            $table->time('check_int_request')->nullable();
            $table->time('check_out_request')->nullable();
            $table->string('evidence', 255)->nullable();
            $table->string('description', 255);
            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('add_timesheets');
    }
}
