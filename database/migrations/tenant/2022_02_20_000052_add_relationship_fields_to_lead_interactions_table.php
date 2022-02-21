<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToLeadInteractionsTable extends Migration
{
    public function up()
    {
        Schema::table('lead_interactions', function (Blueprint $table) {
            $table->unsignedBigInteger('lead_id')->nullable();
            $table->foreign('lead_id', 'lead_fk_6012290')->references('id')->on('leads');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_6012293')->references('id')->on('users');
        });
    }
}
