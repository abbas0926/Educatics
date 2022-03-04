<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantThemePivotTable extends Migration
{
    public function up()
    {
        Schema::create('tenant_theme', function (Blueprint $table) {
            $table->unsignedBigInteger('theme_id');
            $table->foreign('theme_id', 'theme_id_fk_6023030')->references('id')->on('themes')->onDelete('cascade');
            $table->string('tenant_id');
            $table->foreign('tenant_id', 'tenant_id_fk_6023030')->references('id')->on('tenants')->onDelete('cascade');
        });
    }
}
