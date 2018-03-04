<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Orders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function(Blueprint $table){
          $table->increments('id');
          $table->integer('user_id')->nullable()->unsigned();
          $table->foreign('user_id')->nullable()->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
          $table->integer('stuff_id')->nullable()->unsigned();
          $table->foreign('stuff_id')->nullable()->references('id')->on('warehouse')->onUpdate('cascade')->onDelete('set null');
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
        Schema::dropIfExists('orders');
    }
}
