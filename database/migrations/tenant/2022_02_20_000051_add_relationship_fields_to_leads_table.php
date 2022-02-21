<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToLeadsTable extends Migration
{
    public function up()
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->unsignedBigInteger('marketing_campaign_id')->nullable();
            $table->foreign('marketing_campaign_id', 'marketing_campaign_fk_6012675')->references('id')->on('marketing_campaigns');
        });
    }
}
