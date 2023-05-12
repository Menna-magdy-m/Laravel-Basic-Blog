<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_translations', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('post_id')->nullable();

            $table->string("slug");
            $table->string("title")->nullable()->default("New blog post");
            $table->string("subtitle")->nullable();
            $table->text("meta_keywords")->nullable();
            $table->text("meta_desc")->nullable();
            $table->string("seo_title")->nullable();
            $table->text("body")->nullable();
            $table->text("short_description")->nullable();

            $table->string("use_view_file")->nullable()->comment("should refer to a blade file in /views/");

            

            $table->unsignedInteger("lang_id")->index();
            $table->foreign('lang_id')->references('id')->on('languages');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_translations');
    }
}
