<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomePageSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_page_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('heading')->nullable();
            $table->text('contents')->nullable();
            $table->string('url')->nullable();
            $table->string('button_text')->nullable();
            $table->bigInteger('user_id')->unsigned();
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
        Schema::dropIfExists('home_page_settings');
    }
}
