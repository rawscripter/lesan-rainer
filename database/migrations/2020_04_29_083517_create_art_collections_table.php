<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('art_collections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('art_id')->unsigned();
            $table->bigInteger('collection_id')->unsigned();
            $table->foreign('art_id')
                ->references('id')->on('arts')
                ->onDelete('cascade');
            $table->foreign('collection_id')
                ->references('id')->on('collections')
                ->onDelete('cascade');
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
        Schema::dropIfExists('art_collections');
    }
}
