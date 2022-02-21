<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlePostCategoryPivotTable extends Migration
{
    public function up()
    {
        Schema::create('article_post_category', function (Blueprint $table) {
            $table->unsignedBigInteger('article_id');
            $table->foreign('article_id', 'article_id_fk_6020315')->references('id')->on('articles')->onDelete('cascade');
            $table->unsignedBigInteger('post_category_id');
            $table->foreign('post_category_id', 'post_category_id_fk_6020315')->references('id')->on('post_categories')->onDelete('cascade');
        });
    }
}
