<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDirectorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('directors', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('sort_order');
			$table->integer('remuneration_id')->unsigned();
			$table->string('director');
			$table->double('percentage_of_shares');
			$table->integer('salary_paid');
			$table->integer('other_taxable_income');
			$table->double('balance_on_directors_loan_account');
			$table->foreign('remuneration_id')->references('id')->on('remunerations')->onDelete('cascade');
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
		Schema::drop('directors');
	}

}
