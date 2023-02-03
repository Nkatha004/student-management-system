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
        Schema::create('exam_marks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_subject_id')->unsigned();
            $table -> foreign('student_subject_id') -> references('id') -> on('student_subjects');
            $table->string('term');
            $table->integer('year');
            $table->integer('mark');
            $table->integer('added_by')->unsigned();
            $table -> foreign('added_by') -> references('id') -> on('employees');
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
        Schema::dropIfExists('exam_marks');
    }
};
