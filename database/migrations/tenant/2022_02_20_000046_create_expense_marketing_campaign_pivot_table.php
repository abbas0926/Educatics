<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpenseMarketingCampaignPivotTable extends Migration
{
    public function up()
    {
        Schema::create('expense_marketing_campaign', function (Blueprint $table) {
            $table->unsignedBigInteger('marketing_campaign_id');
            $table->foreign('marketing_campaign_id', 'marketing_campaign_id_fk_6012676')->references('id')->on('marketing_campaigns')->onDelete('cascade');
            $table->unsignedBigInteger('expense_id');
            $table->foreign('expense_id', 'expense_id_fk_6012676')->references('id')->on('expenses')->onDelete('cascade');
        });
    }
}
