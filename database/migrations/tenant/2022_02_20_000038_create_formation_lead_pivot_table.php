<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormationLeadPivotTable extends Migration
{
    public function up()
    {
        Schema::create('formation_lead', function (Blueprint $table) {
            $table->unsignedBigInteger('lead_id');
            $table->foreign('lead_id', 'lead_id_fk_6012552')->references('id')->on('leads')->onDelete('cascade');
            $table->unsignedBigInteger('formation_id');
            $table->foreign('formation_id', 'formation_id_fk_6012552')->references('id')->on('formations')->onDelete('cascade');
        });
    }
}
