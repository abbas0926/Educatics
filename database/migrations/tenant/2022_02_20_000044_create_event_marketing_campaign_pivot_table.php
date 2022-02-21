<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventMarketingCampaignPivotTable extends Migration
{
    public function up()
    {
        Schema::create('event_marketing_campaign', function (Blueprint $table) {
            $table->unsignedBigInteger('marketing_campaign_id');
            $table->foreign('marketing_campaign_id', 'marketing_campaign_id_fk_6012670')->references('id')->on('marketing_campaigns')->onDelete('cascade');
            $table->unsignedBigInteger('event_id');
            $table->foreign('event_id', 'event_id_fk_6012670')->references('id')->on('events')->onDelete('cascade');
        });
    }
}
