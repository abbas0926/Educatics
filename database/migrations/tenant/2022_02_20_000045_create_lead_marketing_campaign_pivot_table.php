<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadMarketingCampaignPivotTable extends Migration
{
    public function up()
    {
        Schema::create('lead_marketing_campaign', function (Blueprint $table) {
            $table->unsignedBigInteger('marketing_campaign_id');
            $table->foreign('marketing_campaign_id', 'marketing_campaign_id_fk_6012671')->references('id')->on('marketing_campaigns')->onDelete('cascade');
            $table->unsignedBigInteger('lead_id');
            $table->foreign('lead_id', 'lead_id_fk_6012671')->references('id')->on('leads')->onDelete('cascade');
        });
    }
}
