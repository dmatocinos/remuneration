<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCompanyTaxesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('company_taxes', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('company_id')->unsigned();
			$table->integer('profit_chargeable');
			$table->double('corporate_tax_rate');
			$table->integer('amount_to_distribute');
			$table->integer('directors_salary');
			$table->integer('number_of_associated_companies');
			$table->boolean('claim_ct_deduction');
			$table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
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
		Schema::drop('company_taxes');
	}

}
