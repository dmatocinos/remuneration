<?php

class Company extends \Eloquent {
	protected $fillable = [
		'user_id',
		'name',
		'address',
		'telephone_number',
		'email',
		'website',
		'contact_name',
		'contact_telephone_number'
	];

	public function remuneration()
	{
		return $this->hasOne('Remuneration');
	}
}
