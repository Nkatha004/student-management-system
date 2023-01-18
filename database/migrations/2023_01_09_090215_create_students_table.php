<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('guardian_name');
            $table->string('guardian_phone_number');
            $table->string('guardian_email')->unique();
            $table->integer('class_id')->unsigned()->nullable();
            $table -> foreign('class_id') -> references('id') -> on('classes');
            $table->integer('school_id')->unsigned();
            $table -> foreign('school_id') -> references('id') -> on('schools');
            $table->enum('status', ['Active', 'Archived', 'Deleted'])->default('Active');
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
        Schema::dropIfExists('students');
    }
};
