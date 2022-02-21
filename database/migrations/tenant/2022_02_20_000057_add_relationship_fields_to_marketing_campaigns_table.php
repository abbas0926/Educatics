<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMarketingCampaignsTable extends Migration
{
    public function up()
    {
        Schema::table('marketing_campaigns', function (Blueprint $table) {
            $table->unsignedBigInteger('manager_id')->nullable();
            $table->foreign('manager_id', 'manager_fk_6012667')->references('id')->on('users');
        });
    }
}
