<?php

class Accountant extends \Eloquent {
	protected $fillable = [
		'user_id',
		'practice_name',
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
