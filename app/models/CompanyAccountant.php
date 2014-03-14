<?php

class CompanyAccountant extends \Eloquent {
	protected $fillable = [];

	public function company()
	{
		return $this->belongsTo('Company');
	}

}
