<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonStudentPivotTable extends Migration
{
    public function up()
    {
        Schema::create('lesson_student', function (Blueprint $table) {
            $table->unsignedBigInteger('lesson_id');
            $table->foreign('lesson_id', 'lesson_id_fk_6012577')->references('id')->on('lessons')->onDelete('cascade');
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id', 'student_id_fk_6012577')->references('id')->on('students')->onDelete('cascade');
        });
    }
}
