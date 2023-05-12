<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->increments('id');

            $table->string("name")->unique();
            $table->string("locale")->unique();
            $table->string("iso_code")->unique();
            $table->boolean("active")->default(true);
            $table->boolean("rtl")->default(false);

            $table->timestamps();
        });
        
        // Insert arabic and english
        DB::table('languages')->insert(
            array(
                'name' => 'Arabic',
                'locale' => 'ar',
                'iso_code' => 'ar',
                'rtl' => true
            )
        );
        DB::table('languages')->insert(
            array(
                'name' => 'English',
                'locale' => 'en',
                'iso_code' => 'en',
                'rtl' => false
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('languages');
    }
}
