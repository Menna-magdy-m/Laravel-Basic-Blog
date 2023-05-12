<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_translations', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('category_id')->nullable();

            $table->string("category_name")->nullable();
            $table->string("slug")->unique();
            $table->mediumText("category_description")->nullable();

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
        Schema::dropIfExists('category_translations');
    }
}
