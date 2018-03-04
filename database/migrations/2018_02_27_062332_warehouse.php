<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Warehouse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouse', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->integer('price')->nullable();
            $table->integer('photo_id')->nullable()->unsigned();
            $table->foreign('photo_id')->nullable()->references('id')->on('photos')->onUpdate('cascade')->onDelete('set null');
            $table->integer('user_id')->nullable()->unsigned();
            $table->foreign('user_id')->nullable()->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
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
        Schema::dropIfExists('warehouse');
    }
}
