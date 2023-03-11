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
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->integer('tsc_number')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('telephone_number');
            $table->string('gender');
            $table->integer('school_id')->unsigned()->nullable();
            $table -> foreign('school_id') -> references('id') -> on('schools');
            $table->integer('role_id')->unsigned();
            $table -> foreign('role_id') -> references('id') -> on('roles');
            $table->string('profile_image')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('employees');
    }
};
