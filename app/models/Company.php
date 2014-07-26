<?php

class Company extends \Eloquent {
	protected $fillable = [
		'user_id'
	];

	public function remuneration()
	{
		return $this->hasOne('Remuneration');
	}

	public function getNameAttribute($value)
	{
		if ($client = $this->getClient()) {
			return $client->business_name;
		}
		return null;
	}

	public function getAddressAttribute($value)
	{
		if ($client = $this->getClient()) {
			return $client->address_1;
		}
		return null;
	}

	public function getTelephoneNumberAttribute($value)
	{
		if ($client = $this->getClient()) {
			return $client->phone_number;
		}
		return null;
	}

	public function getEmailAttribute($value)
	{
		if ($client = $this->getClient()) {
			return $client->email;
		}
		return null;
	}

	public function getWebsiteAttribute($value)
	{
		if ($client = $this->getClient()) {
			return $client->website;
		}
		return null;
	}

	public function getContactNameAttribute($value)
	{
		if ($client = $this->getClient()) {
			return $client->contact_name;
		}
		return null;
	}

	public function getContactTelephoneNumberAttribute($value)
	{
		if ($client = $this->getClient()) {
			return $client->mobile_number;
		}
		return null;
	}

	public function getClient()
	{
		return Client::find($this->remuneration->client_id);
	}
}
