<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cart_items', function(Blueprint $table)
		{
            $table->increments('id');
            $table->integer('cart_id')->unsigned();
            $table->integer('good_id')->unsigned();
            $table->integer('count');
            $table->float('price', 10, 2);
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            $table->float('total_price', 10, 2);
            $table->timestamps();

            $table->foreign('cart_id')->references('id')->on('carts')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cart_items');
	}

}
