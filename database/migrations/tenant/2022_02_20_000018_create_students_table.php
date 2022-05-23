<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('gender')->default('female'); // Because women are always right
            $table->string('phone')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('adresse')->nullable();
            $table->string('study_level')->nullable();
            $table->string('establishement')->nullable();
            $table->string('matricule')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
