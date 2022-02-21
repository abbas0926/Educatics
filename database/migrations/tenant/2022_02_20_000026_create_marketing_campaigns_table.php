<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarketingCampaignsTable extends Migration
{
    public function up()
    {
        Schema::create('marketing_campaigns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->decimal('budget', 15, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
