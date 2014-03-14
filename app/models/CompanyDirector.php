<?php

class CompanyDirector extends \Eloquent {
	protected $fillable = [];

	public function company()
	{
		return $this->belongsTo('Company');
	}
}
