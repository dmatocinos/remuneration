<?php

class Company extends \Eloquent {
	protected $fillable = [];

	public function companyDirectors()
	{
		return $this->hasMany('CompanyDirector');
	}

	public function companyAccountant()
	{
		return $this->hasOne('CompanyAccountant');
	}

	public function companyTax()
	{
		return $this->hasOne('CompanyTax');
	}

	public function getNumberOfDirectorShareholdersAttribute()
	{
		return count($this->company_directors);
	}
}
