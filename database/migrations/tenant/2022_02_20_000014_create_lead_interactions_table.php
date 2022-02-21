<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadInteractionsTable extends Migration
{
    public function up()
    {
        Schema::create('lead_interactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('communication_channel')->nullable();
            $table->longText('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
