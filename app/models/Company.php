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
		$client = $this->getClient();
		return $client->business_name;
	}

	public function getAddressAttribute($value)
	{
		$client = $this->getClient();
		return $client->address_1;
	}

	public function getTelephoneNumberAttribute($value)
	{
		$client = $this->getClient();
		return $client->phone_number;
	}

	public function getEmailAttribute($value)
	{
		$client = $this->getClient();
		return $client->email;
	}

	public function getWebsiteAttribute($value)
	{
		$client = $this->getClient();
		return $client->website;
	}

	public function getContactNameAttribute($value)
	{
		$client = $this->getClient();
		return $client->contact_name;
	}

	public function getContactTelephoneNumberAttribute($value)
	{
		$client = $this->getClient();
		return $client->mobile_number;
	}

	public function getClient()
	{
		return Client::find($this->remuneration->client_id);
	}
}
