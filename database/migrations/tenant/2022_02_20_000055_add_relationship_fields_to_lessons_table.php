<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToLessonsTable extends Migration
{
    public function up()
    {
        Schema::table('lessons', function (Blueprint $table) {
            $table->unsignedBigInteger('group_id')->nullable();
            $table->foreign('group_id', 'group_fk_6012566')->references('id')->on('groups');
            $table->unsignedBigInteger('teacher_id')->nullable();
            $table->foreign('teacher_id', 'teacher_fk_6012567')->references('id')->on('teachers');
            $table->unsignedBigInteger('classroom_id')->nullable();
            $table->foreign('classroom_id', 'classroom_fk_6012570')->references('id')->on('classrooms');
        });
    }
}
