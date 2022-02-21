<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventLeadPivotTable extends Migration
{
    public function up()
    {
        Schema::create('event_lead', function (Blueprint $table) {
            $table->unsignedBigInteger('lead_id');
            $table->foreign('lead_id', 'lead_id_fk_6012655')->references('id')->on('leads')->onDelete('cascade');
            $table->unsignedBigInteger('event_id');
            $table->foreign('event_id', 'event_id_fk_6012655')->references('id')->on('events')->onDelete('cascade');
        });
    }
}
