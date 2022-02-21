<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeePresencesTable extends Migration
{
    public function up()
    {
        Schema::create('employee_presences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('status')->nullable();
            $table->string('note')->nullable();
            $table->datetime('started_at');
            $table->datetime('ended_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
