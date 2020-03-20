<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('size1')->nullable();
            $table->string('size2')->nullable();
            $table->integer('year')->nullable();
            $table->bigInteger('collection_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->string('description')->nullable();
            $table->string('status')->default(0);
            $table->integer('archive')->nullable();
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
        Schema::dropIfExists('arts');
    }
}
