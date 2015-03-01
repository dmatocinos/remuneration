<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('payments', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('remuneration_id')->unsigned();
			$table->double('amount');
			$table->string('transaction_id');
			$table->timestamp('order_time');
			$table->timestamps('order_time');
			
			$table->foreign('remuneration_id')->references('id')->on('remunerations');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('payments');
	}

}
