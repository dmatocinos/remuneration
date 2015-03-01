<?php

class Director extends \Eloquent {
	protected $fillable = [
		'sort_order',
		'remuneration_id',
		'director',
		'percentage_of_shares',
		'salary_paid',
		'other_taxable_income',
		'balance_on_directors_loan_account'
	];

	public function remuneration()
	{
		return $this->belongsTo('Remuneration');
	}
}
