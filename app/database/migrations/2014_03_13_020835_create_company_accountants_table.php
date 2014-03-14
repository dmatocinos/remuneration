<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCompanyAccountantsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('company_accountants', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('company_id')->unsigned();
			$table->string('practice_name');
			$table->text('address');
			$table->string('telephone_no');
			$table->string('email');
			$table->string('website_address');
			$table->string('contact_name');
			$table->string('alt_telephone_no');
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
		Schema::drop('company_accountants');
	}

}
