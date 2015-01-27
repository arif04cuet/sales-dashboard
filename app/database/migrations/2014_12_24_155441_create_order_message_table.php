<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderMessageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('order_messages', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('order_id')->length(10)->unsigned();
            $table->integer('msg_id')->length(10)->unsigned();
            $table->timestamps();
        });
        Schema::table('order_messages', function ($table) {
            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('msg_id')->references('id')->on('messages');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('order_messages');
	}

}
