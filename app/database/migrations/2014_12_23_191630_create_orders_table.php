<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->dateTime('due_date');
            $table->dateTime('order_date');
            $table->string('client');
            $table->string('writer')->nullable();
            $table->tinyInteger('status');
            $table->float('sale_price');
            $table->float('fee')->default(0);
            $table->float('amount_paid')->default(0);
            $table->float('outstanding')->default(0);
            $table->integer('percent')->default(0);
            $table->float('profit')->default(0);
            $table->tinyInteger('no_of_page')->default(1);
            $table->integer('salesman_id')->length(10)->unsigned()->nullable();
            $table->integer('writer_id')->length(10)->unsigned()->nullable();
            $table->integer('qc_id')->length(10)->unsigned()->nullable();
            $table->timestamps();
        });
        Schema::table('orders', function ($table) {
            //$table->foreign('note_id')->references('id')->on('order_notes');
            $table->foreign('writer_id')->references('id')->on('writers');
            $table->foreign('qc_id')->references('id')->on('qc');
            $table->foreign('salesman_id')->references('id')->on('users');
            //$table->foreign('msg_id')->references('id')->on('order_messages');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orders');
    }

}
