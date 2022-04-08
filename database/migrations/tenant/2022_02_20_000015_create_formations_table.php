<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormationsTable extends Migration
{
    public function up()
    {
        Schema::create('formations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('slug')->nullable();
            $table->longText('description')->nullable();
            $table->decimal('price', 15, 2);
            $table->string('duration')->nullable();
            $table->string('duration_type')->nullable(); //hour , dya , week , month.
            $table->string('payment_frequency')->nullable(); //per lesson  ,per week per month ,onetime.
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
