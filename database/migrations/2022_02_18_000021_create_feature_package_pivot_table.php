<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeaturePackagePivotTable extends Migration
{
    public function up()
    {
        Schema::create('feature_package', function (Blueprint $table) {
            $table->unsignedBigInteger('package_id');
            $table->foreign('package_id', 'package_id_fk_6022996')->references('id')->on('packages')->onDelete('cascade');
            $table->unsignedBigInteger('feature_id');
            $table->foreign('feature_id', 'feature_id_fk_6022996')->references('id')->on('features')->onDelete('cascade');
        });
    }
}
