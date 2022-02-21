<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionStudentPivotTable extends Migration
{
    public function up()
    {
        Schema::create('promotion_student', function (Blueprint $table) {
            $table->unsignedBigInteger('promotion_id');
            $table->foreign('promotion_id', 'promotion_id_fk_6012402')->references('id')->on('promotions')->onDelete('cascade');
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id', 'student_id_fk_6012402')->references('id')->on('students')->onDelete('cascade');
        });
    }
}
