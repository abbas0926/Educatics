<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormationMarketingCampaignPivotTable extends Migration
{
    public function up()
    {
        Schema::create('formation_marketing_campaign', function (Blueprint $table) {
            $table->unsignedBigInteger('marketing_campaign_id');
            $table->foreign('marketing_campaign_id', 'marketing_campaign_id_fk_6012669')->references('id')->on('marketing_campaigns')->onDelete('cascade');
            $table->unsignedBigInteger('formation_id');
            $table->foreign('formation_id', 'formation_id_fk_6012669')->references('id')->on('formations')->onDelete('cascade');
        });
    }
}
