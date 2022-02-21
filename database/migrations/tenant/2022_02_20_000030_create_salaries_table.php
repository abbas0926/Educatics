<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalariesTable extends Migration
{
    public function up()
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('month')->nullable();
            $table->decimal('taken_salary', 15, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
