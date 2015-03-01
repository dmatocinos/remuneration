<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRemunerationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('remunerations', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('company_id')->unsigned();
			$table->integer('accountant_id')->unsigned();
			$table->string('name');
			$table->integer('profit_chargeable');
			$table->double('corporate_tax_rate');
			$table->integer('amount_to_distribute');
			$table->integer('directors_salary');
			$table->integer('number_of_associated_companies');
			$table->boolean('claim_ct_deduction');
			$table->integer('from_year');
			$table->integer('to_year');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
			$table->foreign('accountant_id')->references('id')->on('accountants')->onDelete('cascade');
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
		Schema::drop('remunerations');
	}

}
