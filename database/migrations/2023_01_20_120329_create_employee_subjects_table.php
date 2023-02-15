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
        Schema::create('employee_subjects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id')->unsigned();
            $table -> foreign('employee_id') -> references('id') -> on('employees');
            $table->integer('subject_id')->unsigned();
            $table -> foreign('subject_id') -> references('id') -> on('subjects');
            $table->integer('class_id')->unsigned();
            $table -> foreign('class_id') -> references('id') -> on('classes');
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
        Schema::dropIfExists('employee_subjects');
    }
};
