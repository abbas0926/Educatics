<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonsTable extends Migration
{
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->datetime('start_at');
            $table->datetime('ends_at');
            $table->boolean('done')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
